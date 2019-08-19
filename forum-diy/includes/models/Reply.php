<?php

class Reply extends Model {
    public function addReply($replyData) {
        try{

        $db = $this->db;
        $sQuery = $db->prepare('INSERT INTO `comments` VALUES (NULL,:content,NULL,NULL,:topic_id,:user_id)');
        $sQuery->bindValue(':content', $replyData['content']);
        $sQuery->bindValue(':topic_id', $replyData['topic_id']);
        $sQuery->bindValue(':user_id', $replyData['user_id']);
        $sQuery->execute();
        if (!$sQuery->rowCount()) {
            echo '{"status": 0, "message": "Sorry, something went wrong when replying."}';
            exit;
        }
        return $db->lastInsertId();

        
        }catch(PDOException $error){
            // TODO: Insert Logger
            echo '{"status": 0, "message": "Are you sure you didn\'t alter the topic ID?"}';
            exit;
        }      
    }
}