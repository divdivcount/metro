<?php
require_once('modules/db.php'); // DB연결을 위한 같은 경로의 dbconn.php를 인클루드합니다.

$me_recv_mb_id = $_GET['me_recive_mb_id']; // GET 방식으로 넘어온 받는 회원아이디
$pr_id = $_GET['id']; // GET 방식으로 넘어온 받는 제품번호
?>

<html>
<head>
	<title>Memo Form</title>
	  <link rel="stylesheet" href="css/note-3.css">
</head>
<body id="memo">
	<!-- 쪽지 보내기 시작 { -->
	<div class="note">
    <div class="header">
        <div>
            <img src="img/note.png">
            <span class="title">쪽지 보내기</span>

        </div>
    </div>
			<button class="btn1" onclick="location.href ='./memo.php?kind=recive'">받은쪽지</button>
			<button class="btn2" onclick="location.href ='./memo.php?kind=send'">보낸쪽지</button>
	</div>
	<div>

<div class="note2">
		<form name="fmemoform" action="./memo_form_update.php" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off">
			<input type="hidden" name= "id" value="<?=$pr_id?>">
		<div>

				<div class="content">
            <table>
                <tr>
                    <td>보낸사람</td>
                    <td><input type="text" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" id="me_recv_mb_id" readonly required class="frm_input required" size="47"></td>
                </tr>
            </table>
        </div>
				<div class="conbtn">
            <input type="submit" class="cbtn" value="답장하기">
        </div>
		</div>
</div>
<td><textarea name="me_memo" rows="10" cols="50" required></textarea></td>
		</form>
	</div>

	<!-- 쪽지 보내기 끝 { -->
</body>
</html>
