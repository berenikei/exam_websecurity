<?php
$Parsedown = new Parsedown();
?>
<section class="container">
   
   <!-- Not sure we need this row section, could be deleted -->
    <div class="row justify-content-center">
        <div class="col-md-9 pl-3 mb-5 title-container">
            <h1><?= $data['category-name']; ?></h1>

            <p> <?= $data['category-description']; ?></h1></p>
        </div>
    </div>



    <div class="row justify-content-center">

    <div class="col-md-9 pl-3 mb-5">
        
        <!-- This is the original template. 
            <div class="panel panel-default">
            <div class="panel-body">
                    <div class="panel-heading">
                        <h4>Main title or question or topic</h4>
                    </div>
                        <p>Text about explaining the question or something else a bit longer but should be max 2 lines then....</p>
            </div>
            <div class="thread-info">
                <div class="thread-info-avatar">
                <img class="img-circle" src="https://www.ukielist.com/wp-content/uploads/2017/03/default-avatar.png" alt="avatar">
                </div>
                <div class="thread-info-author">
                </div>
                <div class="thread-info-tags">
                    <a href="#">Tag1</a>
                    <a href="#">Tag2</a>
                </div>
            </div>
        </div> -->
        <div id="create-button-wrapper">
                <?php
                if(isset($_SESSION['User'])){
                    echo '<a href="create-topic" class="btn create-topic mb-2">Create topic</a>';
                }
                ?>
            </div>
        <?php 
                // print_r($data); 
                
                foreach ($data['topics'] as $topic) { ?>

                    <a href="topic?id=<?=$topic['id']?>">
                    <div id=<?=$topic['id']?> class="panel panel-default mb-2">
                        <div class="panel-body">
                                <div class="panel-heading">
                                    <h4> <?= htmlentities($topic['topic_name']) ?></h4>
                                </div>
                                  
                                    <?= str_replace(["</p>\n\n<p>", '<p>', '</p>'], ["\n\n", ""],$Parsedown->text(htmlentities(substr($topic['content'], 0, 200)))); ?>...
                        </div>
                        <div class="thread-info">
                            <div class="thread-info-avatar">
                            <img class="img-circle" src="https://www.ukielist.com/wp-content/uploads/2017/03/default-avatar.png" alt="avatar">
                            </div>
                            <div class="thread-info-author">
                                <p> &nbsp <?= htmlentities($topic['username']) ?></p>
                            </div>
                            <div class="thread-info-tags">
                                
                            </div>
                        </div>
                    </div>
                    </a>
                    <?php
                }
            ?>

    </div>


</section>
