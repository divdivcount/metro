<?php
  require("db_connect.php");
  $num = empty($_REQUEST["num"]) ? "" : $_REQUEST["num"];
  $u_id = empty($_REQUEST["u_id"]) ? "" : $_REQUEST["u_id"];

  function mq($sql) {
    global $db;
    return $db->query($sql);
  }
?>

<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="css/reply.css">
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
</head>

<body>
  <div class="container">
		<div class="reply_view">
			<h3 style="padding:10px 0 15px 0; border-bottom: solid 1px gray;">댓글목록</h3>
			<?php
				$sql3=mq("select * from reply where num='".$num."' order by idx desc ");
				while($reply=$sql3->fetch(PDO::FETCH_ASSOC)){
			?>
		    <div class="dat_view">
					<div><b><?=$reply['name']?></b></div>
					<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
					<div class="rep_me dap_to"><?=$reply['date']?></div>
					<div class="rep_me rep_menu">
					</div>
				</div>

				<div class="modal fade" id="rep_modal_del">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title"><b>댓글 삭제</b></h4>
              </div>
              <div class="modal-body">
                <form method="get" id="modal_form" action="reply_delete.php">
                  <input type="hidden" name="rno" value="<?=$reply['idx']?>" />
                  <input type="hidden" name="b_no" value="<?=$num?>">
				          <p>비밀번호 <input type="password" name="pw" /> <input type="submit" class="btn btn-primary" value="확인" /></p>
				        </form>
				      </div>
            </div>
          </div>
        </div>

				<?php
        }
        ?>

				<div class="dat_ins">
					<input type="hidden" name="bno" class="bno" value=<?=$num?>>
					<input type="hidden" name="dat_user" id="dat_user" class="dat_user" value=<?=$u_id?>>
					<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
					<div style="margin-top:10px;">
						<textarea name="content" class="rep_con" id="rep_con"></textarea>
						<button id="rep_btn" class="rep_btn">댓글</button>
					</div>
				</div>
			</div>
		</div>

  <script>
  $(document).ready(function() {

    $("#rep_btn").click(function() {
      $.ajax({
        url : "reply_ok.php",
        type : "get",
        data : {
          "bno" : $(".bno").val(),
          "dat_user" : $(".dat_user").val(),
          "dat_pw" : $(".dat_pw").val(),
          "rep_con" : $(".rep_con").val(),
        },
        success : function(data) {
        alert("댓글이 작성되었습니다");
        location.reload();
        }
      });
    });

    $(".dat_del_btn").click(function() {
      $("#rep_modal_del").modal();
    });
  });
  </script>
  </body>
</html>
