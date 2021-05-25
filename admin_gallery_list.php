<?php
// Load Modules
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once("modules/admin.php");

// Parameter
$pid = Get('p', 1);

// Functions

// Process
$galleryObj = new Gallery;
$result = $galleryObj ->SelectGallery();
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <title></title>
    <link rel="stylesheet" href="css/css_noamlfont.css">
    <link href="css/css_sub2.css" rel="stylesheet" type="text/css">
    <link href="css/admin_cul.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </head>
  <body>
    <main>
      <div>

        <ul id="sub"><!-- list-> oppenUploader함수실행 -->
          <li><button type="button" name="button" onclick="list.openUploader()">추가</button></li>
          <li><button type="button" name="button" onclick="list.openList()">돌아가기</button></li>
          <li><button type="button" name="button" onclick="list.cancel()">선택취소</button></li>
          <li><button type="button" name="button" onclick="list.dom.deleteForm.submit()">삭제</button></li>
          <li id="len"></li><!-- list->openList()함수실행 -->                                                                      <!-- list.cancel()함수실행 -->
        </ul><!-- list-> dom -> deleteForm.submit()함수실행 -->

        <form id="modifyForm" action="admin_gallery_modify.php" method="post">
          <input type="text" name="id" class="hidden">
          <input type="text" name="description" class="hidden">
        </form>
        <form id="deleteForm" action="admin_gallery_delete.php" method="post">
          <h3>Main Logo(이미지 사이즈 1920*700)</h3>
          <div id="gallery">
              <?php $i = 0; ?><!-- 체크 고유 아이디 -->
              <?php if($result) : ?>
              <?php foreach($result as $row) : ?>
                <div class="banner_box">
                  <div class="bannerImg_box"><img src="files/gallery/<?= $row['fname'] ?>" alt=""></div>
                  <div class="banner_selectBox">
                    <input type="checkbox" name="id[]" value="<?= $row['id'] ?>">
                    <label onclick="list.pick(<?= $i ?>)"></label>
                    <input type="text" name="description" onkeyup="backdoor(<?= $i ?>)" placeholder="<?= $row['description'] ?>">
                    <button type="button" class="chaneLink_btn" onclick="list.modify(<?= $i++ ?>)" disabled>링크 수정</button>
                  </div>

                </div>
              <?php endforeach ?>
            <?php else : ?>
              <div>
                <h2 style="width:300px;">사진을 등록해주세요.</h2>
              </div>
          <?php endif ?>
          </div>
        </form>


        <form id="uploadForm" action="admin_gallery_upload.php" method="post" enctype="multipart/form-data">
          <input type="file" name="files[]" id="realInput" class="hidden" value="" accept="image/jpeg,image/png,image/gif" onchange="imageURL(this)" multiple="multiple">
          <h3>Main Logo(이미지 사이즈 1920*700)</h3>
          <button type="button" id="fake_fileInput" class="selectImg_btn">파일선택</button>
          <button type="submit" name="upload" class="uploadImg_btn">업로드</button>
          <div class="imgs">

          </div>
        </form>
      </div>

      <script type="text/javascript">
      var domMain = document.getElementById('sub').getElementsByTagName('li');//sub아이디 값에 li를 찾는다.
      var list = {
        dom: {
          section: {
            upload: document.getElementById('uploadForm'),//id 값인 업로드 폼
            list: document.getElementById('deleteForm')//id 딜리트폼
          },
          menuLine: {
            upload: domMain[0].children[0],
            list: domMain[1].children[0],
            del: domMain[2].children[0],
            cancel: domMain[3].children[0],
            count: document.getElementById('len')
          },
          boxes: {
            box: document.getElementById('gallery').getElementsByClassName('banner_box'),
            getId: function(i) {
              return this.box[i].querySelector('.banner_selectBox').children[0];
            },
            getDescription: function(i) {
              return this.box[i].querySelector('.banner_selectBox').children[2];
            },
            getSubmit: function(i) {
              return this.box[i].querySelector('.banner_selectBox').children[3];
            }
          },
          modifyForm: {
            form: document.getElementById('modifyForm'),
            id: document.getElementById('modifyForm').children[0],
            description: document.getElementById('modifyForm').children[1]
          },
          deleteForm: document.getElementById('deleteForm')
        },
        count: 0,
        pick: function(i) {
          if(!this.dom.boxes.getId(i).checked) {
            this.dom.boxes.getId(i).checked = true;
            this.count++;
          }
          else {
            this.dom.boxes.getId(i).checked = false;
            this.count--;
          }
          this.refresh();
        },
        refresh: function() {
          if(this.count>0) {
            this.dom.menuLine.count.innerText = this.count + '개 선택됨.';
            this.dom.menuLine.del.style.display = '';
            this.dom.menuLine.cancel.style.display = '';
          }
          else {
            this.dom.menuLine.count.innerText = '';
            this.dom.menuLine.del.style.display = 'none';
            this.dom.menuLine.cancel.style.display = 'none';
          }
        },
        modify: function(i) {
          this.dom.modifyForm.id.value = this.dom.boxes.getId(i).value;
          this.dom.modifyForm.description.value = this.dom.boxes.getDescription(i).value;
          this.dom.modifyForm.form.submit();
        },
        check: function(i) {
          if(this.dom.boxes.getDescription(i).value == '') {
            this.dom.boxes.getSubmit(i).disabled = true;
          }
          else {
            this.dom.boxes.getSubmit(i).disabled = false;
          }
        },
        cancel: function() {
          for(var i=0; i<this.dom.boxes.box.length; i++) {
            this.dom.boxes.getId(i).checked = false;
          }
          this.count = 0;
          this.refresh();
        },
        openList: function() {
          this.dom.menuLine.upload.style.display = '';
          this.dom.section.upload.style.display = 'none';
          this.dom.menuLine.list.style.display = 'none';
          this.dom.section.list.style.display = '';
        },
        openUploader: function() {
          this.dom.menuLine.upload.style.display = 'none';
          this.dom.section.upload.style.display = '';
          this.dom.menuLine.list.style.display = '';
          this.dom.section.list.style.display = 'none';
        }
      };
      function backdoor(i) {
        list.check(i);
      }
      list.dom.menuLine.del.style.display = 'none';
      list.dom.menuLine.cancel.style.display = 'none';
      list.dom.menuLine.list.style.display = 'none';
      list.dom.section.upload.style.display = 'none';
      </script>

      <script type="text/javascript">
      initImages();

      function imageURL(input) {
        initImages();
        if (input.files && input.files.length>0) {
          document.getElementsByName('upload')[0].disabled = false;
          var onloadcallback = function(e) {
            //document.getElementsByTagName('img')[0].setAttribute('src', e.target.result);
            makeImage(e.target.result);
          };

          for(var i=0; i<input.files.length; i++) {
            var reader = new FileReader();
            reader.onload = onloadcallback;
            reader.readAsDataURL(input.files[i]);
          }
        }
      }

      function initImages() {
        document.getElementsByClassName('imgs')[0].innerHTML = '';// imgs 태크를 찾아서 0번배열에 '' 넣기
        document.getElementsByName('upload')[0].disabled = true; //업로드 이름을 찾아 [0]번 배열에 버튼 비활성화
      }

      function makeImage(src) { //imgurl을 위한 함수
        var box = document.createElement('div'); //div 생성
        var obj = document.createElement('img');//img 태크생성
        var in1 = document.createElement('input'); // 인풋태크 생성
        in1.setAttribute('placeholder', '사진 설명을 입력'); //인풋 placeholder설정
        in1.setAttribute('type', 'text'); // type text
        in1.setAttribute('name', 'names[]'); // namse배열
        obj.setAttribute('src', src);//경로
        var cnter = document.getElementsByClassName('imgs')[0];//imgs 태크이름을 가져와서 obj,in1를 넣는다.
        box.appendChild(obj);//box == div ->obj
        box.appendChild(in1);//box ==div ->input
        cnter.appendChild(box);//imgs 태크이름을 가져와서 obj,in1를 넣는다.
      }

      var fake_fileInput=document.getElementById('fake_fileInput');
      var realInput=document.getElementById('realInput');
        fake_fileInput.addEventListener('click',()=>{
         realInput.click();
       });

      </script>
    </main>
  </body>
</html>
