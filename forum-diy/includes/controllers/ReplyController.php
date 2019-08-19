<?php


class ReplyController extends Controller
{
    public static function addReply()
    {

        if (!isset($_SESSION['User']) || !hash_equals($_SESSION['key'], $_POST['token'])){
            echo '{"status":"0","message":"Invalid token."}';
            exit;
        }
        
        $_POST['user_id'] = (int)$_SESSION['User']['id'];
        $_POST['topic_id'] = (int)$_POST['topic_id'];
        Validation::checkInput($_POST['user_id'],'integer','','');
        Validation::checkInput($_POST['topic_id'],'integer','','');
        Validation::checkInput($_POST['content'],'string',5,'');
        
        $replyData = $_POST;
        $replyModel = new Reply();
        $newCommentId = $replyModel->addReply($replyData);
        // We use the number of comments so far plus the new one to 
        // determine the number of pages of comments the topic would
        // have then we use the page to navigate to the last page.
        // We also pass newcommentId in order to scroll to the specific
        // comment and not arrive just at the top of the page.
        $numberOfComments = $_POST['number_of_com'];
        $numberOfPages = ceil(($numberOfComments + 1) / 5);
        
        echo '{"status":"1","message":"Reply added", "location":"topic?id='.$_POST['topic_id'].'&page='.$numberOfPages.'&com='.$newCommentId.'"}';        
    }
}