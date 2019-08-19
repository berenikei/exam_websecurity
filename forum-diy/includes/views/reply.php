<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Replying to "<?= htmlentities($_GET['title']) ?>"</h1>
        </div>
        <div class="col-md-8">
            <!-- Error message-->
            <div id="err-msg" class="alert alert-warning" style="display:none;">
                <p style="margin: 0">Something went wrong, please try again.</p>
            </div>
             <!-- Successful signup message-->
             <div id="succ-msg" class="alert alert-success" style="display:none;">
                <p>Your reply was added successfully.
                    You'll be redirected to the topic page in a moment...</p>
            </div>

            <form id="reply-form">
                <div class="form-group">
                    <label for="content"></label>
                    <textarea id="content"></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="token" value="<?= $csrf ?>">
                    <input type="hidden" name="topic_id" value="<?= htmlentities($_GET['id']) ?>">
                    <input type="hidden" name="number_of_com" value="<?= htmlentities($_GET['com']) ?>">
                    <button class="btn btn-primary" id="btnSubmit" type="submit">Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>