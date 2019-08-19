<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit a topic</h1>
        </div>
        <div class="col-md-8">
            <!-- Error message-->
            <div id="err-msg" class="alert alert-warning" style="display:none;">
                <p style="margin: 0">Something went wrong, please try again.</p>
            </div>

            <!-- Successful signup message-->
            <div id="succ-msg" class="alert alert-success" style="display:none;">
                <p>Your topic was added successfully.
                    You'll be redirected to the main page in a moment...</p>
            </div>
            <form id="new-topic-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="topic_name">Title</label>
                    <input type="text" class="form-control" id="topic_name" name="topic_name"
                        placeholder="Enter the topic name here" value="<?= htmlentities($data->topicData['topic_name'])?>" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required readonly disabled>
                        <?php
                        foreach ($data as $key => $category) {
                            ?>
                            <option value="<?= htmlentities($category['id'])?>">
                                <?= htmlentities($category['category_name']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <!-- IMAGE UPLOAD -->
                <div class="form-group">
                    <label for="image">Upload a featured image</label>
                    <input name="image_upload" type="file" accept="image/*" >
                </div>
                <div class="form-group">
                    <label for="content">Write your thoughts down...</label>
                    <textarea id="content"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="token" value="<?= $csrf ?>">
                    <input type="hidden" name="image_path_old" value="<?= htmlentities($data->topicData['featured_image_url'])?>">
                    <?php
                    /*
                     *  WARNING
                     * The following method can create vulnerability and allow
                     * hacker to edit different post
                     * Therefore it is important to check the user's rights again in the Model
                     */
                    ?>
                    <input type="hidden" name="topic_id" value="<?= htmlentities($data->topicData['id'])?>">
                    <input type="hidden" id="currentContent" value="<?=htmlentities($data->topicData['content'])?>">
                    <button class="btn btn-primary" id="btnSubmit" type="submit">Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>