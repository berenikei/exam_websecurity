<?php


class Topics extends Model
{
    public function get_topic_with_comments($iTopicId, $iOffset)
    {
        try {
            // Make a call to the database
            // Make a SELECT statement here, prepare, and execute
            $sTopicContentQuery = $this->db->prepare('CALL get_topic_by_id(:topicId)');
            $sTopicContentQuery->bindValue(':topicId', $iTopicId);
            $sTopicContentQuery->execute();
            $topicContent = $sTopicContentQuery->fetch();
            // check if anything was received
            if ($topicContent['id'] == NULL) {
                return false;
            }
        } catch (PDOException $error) {
            LogSaver::save_the_log($error, 'topics.txt');
            // die or go o to 404?
            die();
        }
        try {
            // Michal:  If the topic exists, now we retrieve comments
            // Closing cursor first is to close connection from above
            $sTopicContentQuery->closeCursor();
            $sCommentsQuery = $this->db->prepare('CALL get_comments_for_the_topic(:topicId, :offset)');
            $sCommentsQuery->bindValue(':topicId', $iTopicId);
            $sCommentsQuery->bindValue(':offset', $iOffset);
            $sCommentsQuery->execute();
            $commentsContent = $sCommentsQuery->fetchAll();
        } catch (PDOException $error) {
            LogSaver::save_the_log($error, 'topics.txt');
        }
        // closing the connection
        // $sCommentsQuery = null;
        // Creating a passing object
        $objTopic = new stdClass();
        $objTopic->topicData = $topicContent;
        $objTopic->commentData = [];
        $objTopic->whats = $topicContent;
        $objTopic->numberOfComments = 0;
        $objTopic->numberOfPages = 1;

        if (!empty($commentsContent)) {

            /*
            * Currently, we have two objects -> $topicContent and $commentsContent
            * Both are arrays
            * I suggest merging them into one, so we can pass it as object expected by CreateView
            */
            $objTopic->commentData = $commentsContent;


            /*
             * Calculate number of pages by dividing total
             * number of pages by number of results, which is 5
             * If you want to change that, please contact
             * the database administrator ;)
             * AKA change in the routines
             *
             * So I figured that count($commentsContent) is always returning 5...
             * obviously, therefore I need to make another quick call to the database
             * to ask how many comments there are
             *
             * IF YOU HAVE ANOTHER IDEA, YOU'RE WELCOME TO TRY IT OUT
             *
             */
            try {
                // Again, closing the connection from abote
                $sCommentsQuery->closeCursor();
                $sNumberOfCommentsQuery = $this->db->prepare('CALL get_number_of_comments(:topicId)');
                $sNumberOfCommentsQuery->bindValue(':topicId', $iTopicId);
                $sNumberOfCommentsQuery->execute();
                /*
                 * That technically should return something since it passed
                 * check if any comments already.
                 */
                $numberOfComments = $sNumberOfCommentsQuery->fetch();
            } catch (PDOException $error) {
                LogSaver::save_the_log($error, 'topics.txt');
            }
            $iNumberOfComments = $numberOfComments['totalComments'];

            $iNumberOfPages = ceil($iNumberOfComments / 5);
            $objTopic->numberOfComments = $iNumberOfComments;
            $objTopic->numberOfPages = $iNumberOfPages;
            // $objTopic->whats = $topicContent;

        }

        return $objTopic;


//        } catch (PDOException $error) {
//            LogSaver::save_the_log($error, 'topics.txt');
//        }
    }

    public function get_topic($iTopicId)
    {
        try {
            //prepare the statement
            $sTopicContentQuery = $this->db->prepare('SELECT t.id, t.topic_name, t.date_created, t.category_id,t.user_id, t.content, t.featured_image_url, c.category_name
                                                                FROM topics as t
                                                                JOIN categories c on t.category_id = c.id
                                                                WHERE t.id = :topicId');
            $sTopicContentQuery->bindValue(':topicId', $iTopicId);
            $sTopicContentQuery->execute();
            $topicContent = $sTopicContentQuery->fetch();
            //check if anything was received
            if (count($topicContent) == 0) {
                echo '{"status":"0","message":"Something went wrong, please contact the support"}';
                die();
            }
            $objTopic = new stdClass();
            $objTopic->topicData = $topicContent;
            return $objTopic;

        } catch (PDOException $e) {
            echo '{"status":"0","message":"Something went wrong, please contact the support"}';
            //Saving the errors in txt file to keep track what happen in case something breaks
            LogSaver::save_the_log($e, 'topics.txt');
        }

    }

    public function getTopicsFromCategory($category)

    {
        try {
            $sQuery = $this->db->prepare('CALL get_topics_from_category(:categoryId)');
            $sQuery->bindValue(':categoryId', $category);
            $sQuery->execute();
            $aTopics = $sQuery->fetchAll();
            if (count($aTopics)) {

                return $aTopics;
                exit;
            }
            return 'Sorry, no topics found in this category';
        } catch (PDOException $error) {
            // Correct this error for production
            echo '{"status": 0, "message": "Sorry, something went wrong. Try again later."}';
            LogSaver::save_the_log($error, 'topic.txt');
        }

    }

    public function create_topic($topicData)
    {
        // print_r($topicData);    
        try {
            // TODO: Emit default.png when no image is uploaded
            if (isset($topicData['image'])) {
                $imagePath = $topicData['image']['name'];
            } else {
                $imagePath = 'default.png';
            }
            $db = $this->db;
            $sQuery = $db->prepare('INSERT INTO `topics` VALUES (NULL,:topic_name,NULL,NULL,:category_id,:user,:content,:featured_image)');
            // Could not get the last inserted ID when using the stored procedure
            // The procedure code itself has to be updated somehow, but I didnt manage
            // to make it work. - PETER
            // $sQuery = $db->prepare('CALL create_topic(:topic_name, :category_id, :user_id, :content)');
            $sQuery->bindValue(':topic_name', $topicData['topic_name']);
            $sQuery->bindValue(':category_id', $topicData['category_id']);
            $sQuery->bindValue(':user', $topicData['user_id']);
            $sQuery->bindValue(':content', $topicData['content']);
            $sQuery->bindValue(':featured_image', $imagePath);
            $sQuery->execute();
            if (!$sQuery->rowCount()) {
                echo '{"status": 0, "message": "Sorry, something went wrong when creating topic."}';
                exit();
            }
            if (isset($topicData['image'])) {
                if (move_uploaded_file($topicData['image']['tmp_name'], 'static/images/' . $topicData['image']['name'])) {
                    $sImage = $topicData['image']['name'];
                } else {
                    echo '{"status":0, "message":"Failed to upload photo."}';
                    exit;
                }
            }
            $id = $db->lastInsertId();
            // TODO:Remember to update this echo once its paired with some AJAX
            echo '{"status": 1, "message": "topic created", "topic": ' . $id . ' }';
        } catch (PDOException $error) {
            echo '{"status": 0, "message": "Sorry, something went wrong. Try again later."}';
            LogSaver::save_the_log($error, 'topics.txt');
            exit();
        }
    }

    public function update_topic($topicData)
    {
        try {
            $db = $this->db;

            /*
             * For now we need to have two different prepare statements for moderator
             * and for the privileged user
             */
            if(UserPrivilegesChecker::is_moderator($_SESSION['User']['id'])){
                $sQuery = $db->prepare('UPDATE lifehack.topics t
                                                SET t.topic_name = :topic_name,
                                                    t.content    = :content,
                                                    t.featured_image_url = :featured_image
                                                WHERE t.id = :topic_id');
            } else {
                $sQuery = $db->prepare('UPDATE lifehack.topics t
                                                SET t.topic_name = :topic_name,
                                                    t.content    = :content,
                                                    t.featured_image_url = :featured_image
                                                WHERE t.id = :topic_id AND t.user_id = :user_id');

            }
            $sQuery->bindValue(':topic_name', $topicData['topic_name']);
            if (isset($topicData['image'])) {
                $imagePath = $topicData['image']['name'];
                $sQuery->bindValue(':featured_image', $imagePath);
            } else {
                $sQuery->bindValue(':featured_image', $topicData['image_path_old']);
            }
            $sQuery->bindValue(':topic_id', $topicData['topic_id']);

            // IF IT'S A USER
            if(!UserPrivilegesChecker::is_moderator($_SESSION['User']['id'])){
                $sQuery->bindValue(':user_id', $_SESSION['User']['id']);
                $sQuery->bindValue(':content', $topicData['content']);
            } else {
                // IF IT'S A MODERATOR, APPEND
                $topicData['content'] = $topicData['content'].
                    '
                    > This post has been edited by a moderator '.$_SESSION['User']['username'];
                $sQuery->bindValue(':content', $topicData['content']);
            }
            $sQuery->execute();
            if (!$sQuery->rowCount()) {
                echo '{"status": 0, "message": "Nothing was updated"}';
                exit();
            }
            if (isset($topicData['image'])) {
                if (move_uploaded_file($topicData['image']['tmp_name'], 'static/images/' . $topicData['image']['name'])) {
                    $sImage = $topicData['image']['name'];
                } else {
                    echo '{"status":0, "message":"Failed to upload photo."}';
                    exit;
                }
            }
            // TODO: Remember to update this echo once its paired with some AJAX
            echo '{"status": 1, "message": "topic updated", "topic": ' . $topicData['topic_id'] . ' }';
        } catch (PDOException $error) {

            echo '{"status": 0, "message": "Sorry, something went wrong updating the topic. Try again later."}';
            LogSaver::save_the_log($error, 'topics.txt');
            exit();
        }
    }

}