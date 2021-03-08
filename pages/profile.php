<?php

    if (isset($_GET['id'])) {
        $profile_id = (int) $_GET['id'];
    } else if (isLogin()) {
        $profile_id = (int) $_SESSION['id'];
    } else {
        header("Location: ../home/");
    }

    if ($stmt = $conn -> prepare("SELECT * FROM `profile` WHERE id = ?")) {
        $stmt->bind_param('i', $profile_id);
        if (!$stmt->execute()) {
            header("Location: ../home/");
        } else {
            $pic = $row['profile'] ? $row['profile'] : "../static/elements/user.png";
        }
    }
?>
<div class="container" style="padding-top: 88px;">
    <div class="container mb-3" id="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <img src="../static/elements/user.png" class="card-img-top img-fluid mb-3" alt="Profile">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="picture" aria-describedby="picture">
                                <label class="custom-file-label" for="picture">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" id="save" name="save" class="btn btn-coekku btn-block">Save</button>
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div id="owo">
                        <?php $Parsedown = new Parsedown();

                        echo $Parsedown->text('Hello _Parsedown_!');?>
                        </div>
                        <hr>
                        <div id="test-editor">
                            <textarea style="display:none;" id="AYAYA">### Editor.md
                            
                            **Editor.md**: The open source embeddable online markdown editor, based on CodeMirror & jQuery & Marked.
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $(function () {
        var editor = editormd("test-editor", {
            width: "100%",
            height: "500",
            path: "../vendor/editor.md/lib/",
            theme : "<?php if (isDarkmode()) echo "dark"; else "default"; ?>",
            previewTheme : "<?php if (isDarkmode()) echo "dark"; else "default"; ?>",
            editorTheme : "<?php if (isDarkmode()) echo "monokai"; else "default"; ?>",
            emoji: true,
            toolbarIcons : function() {
                return [
                    "undo", "redo", "|",
                    "bold", "del", "italic", "quote", "|",
                    "h1", "h2", "h3", "h4", "h5", "h6", "|",
                    "list-ul", "list-ol", "hr", "|",
                    "link", "reference-link", "image", "code", "preformatted-text", "code-block", "table", "emoji", "|",
                    "watch", "preview", "search", "|",
                    "help", "info"
                ];
            }
        });
    });
</script>