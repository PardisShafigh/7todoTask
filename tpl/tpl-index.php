<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php echo SITE_TITLE ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="page">
    <div class="pageHeader">
      <div class="title">Dashboard</div>
      <div class="userPanel">
        <a href="<?php echo site_url('?logout=1') ?>"><i class="fa fa-sign-out"></i></a>
      <span class="username"><?php echo $user->name ?? "Unknown"; ?></span>
      <img src="<?php echo $user->image; ?>" width="40" height="40" /></div>
    </div>
    <div class="main">
      <div class="nav">
        <div class="searchbox">
          <div><i class="fa fa-search"></i>
            <input type="search" placeholder="Search" />
          </div>
        </div>
        <div class="menu">
          <div class="title">Folders</div>
          <ul class="folder-list">
            <li class="<?php isset($_GET['folder_id']) ? "" : "active" ?>active">
              <a href="<?php echo site_url() ?>"><i class="fa fa-folder"></i>All</a>
            </li>
            <?php foreach ($folders as $folder) : ?>
              <li class="<?php ($_GET["folder_id"] == $folder_id->id) ? "active" : "" ?>">
                <a style='text-decoration:none;' href="<?php echo site_url("?folder_id=$folder->id") ?>"><i class="fa fa-folder"></i><?php echo $folder->name ?></i></a>
                <a onclick="return confirm('Are You Sure to delete this Item?\n<?php echo $folder->name ?>');" style='text-decoration:none;color:#d12222 !important;float:right;font-weight:200;padding-right:5px;hover:font weight 700px' href="?delete_folder=<?php echo $folder->id ?>"><i class="fa fa-trash-o"></i></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div>
          <input type="text" id="addFolderInput" style="width: 50%;margin-left:10%;" placeholder="Add New Folder" />
          <button id="addFolderBtn" class="btn clickable">+</button>
        </div>
      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title" style="width: 50%;">
            <input type="text" id="taskNameInput" style="width: 100%;margin-left:10%;line-height: 30px;" placeholder="Add New Task">
          </div>
          <div class="functions">
            <div class="button active"></div>
            <div class="button">Completed</div>
          </div>
        </div>
        <div class="content">
          <div class="list">
            <div class="title">Today</div>
            <ul>

              <?php if (sizeof($tasks)) : ?>
                <?php foreach ($tasks as $task) : ?>
                  <li class="<?php echo $task->is_done ? 'checked' : ''; ?>">


                    <i data-taskId="<?php echo $task->id ?>" class="isDone clickable fa <?php echo $task->is_done ? 'fa-check-square-o' : 'fa-square-o'; ?>"></i>


                    <span><?php echo $task->title ?></span>
                    <div class="info">
                      <span style=" font-size: 11px;margin-right: 12px;" class='created-at'>Created At <?php echo $task->created_at ?></span>
                      <a onclick="return confirm('Are You Sure to delete this Item?\n<?php echo $task->title ?>');" style="text-decoration:none;color:#d12222 !important;float:right;font-weight:200;" href="?delete_task=<?php echo $task->id ?>"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </li>
                <?php endforeach; ?>
              <?php else : ?>
                <li>NO Task Here ..</li>
              <?php endif; ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>

  </script>
  <script src="assets/js/script.js"></script>

  <script>
    $(document).ready(function() {
      $('.isDone').click(function(e) {
        var tid = $(this).attr("data-taskId")
        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "doneSwitch",
            taskId: tid
          },
          success: function(response) {
            if (response == '1') {
              location.reload();
            } else {
              alert(response);
            }
          }
        });
      });
      $('#addFolderBtn').click(function(e) {
        var input = $('input#addFolderInput');
        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "addFolder",
            folderName: input.val()
          },
          success: function(response) {
            if (response == '1') {
              $('<li><a style="text-decoration:none;color:#1788b3;" href="#"><i class="fa fa-folder"></i>' + input.val() + '</a></li>').appendTo("ul.folder-list");
            } else {
              alert(response);
            }
          }
        });
      });



      $('#taskNameInput').on('keypress', function(e) {
        e.stopPropagation();
        if (e.which == 13) {
          $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
              action: "addTask",
              folderId: <?php echo $_GET["folder_id"] ?? 0 ?>,
              taskTitle: $('#taskNameInput').val()
            },
            success: function(response) {
              if (response == '1') {
                location.reload();
              } else {
                alert(response);
              }
            }
          });
        }
      });

      $('#taskNameInput').focus();

    });
  </script>

</body>

</html>