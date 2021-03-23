<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php


     ?>

    <div>
      <form class="" action="index.php" method="post">
        <input type="text"  id="search_box"  placeholder="자동완성" />
        <input type="submit"/>
      </form>
    </div>

    <script>

    var link = 'http://localhost/index.php?'

    $("#testInput").autocomplete({
        source : function(request, response) {
            $.ajax({
                  url : "autocomplete_keyword.php"
                , type : "GET"
                , data : {keyword : $("#search_box").val()} // 검색 키워드
                , success : function(data){ // 성공
                    response(
                        $.map(data, function(item) {//써보고 추후 업데이트 요망
                            return {
                                  label : item.testNm    //목록에 표시되는 값
                                , value : item.testNm    //선택 시 input창에 표시되는 값
                            };
                        })
                    );    //response
                }
                ,
                error : function(){ //실패
                    alert("통신에 실패했습니다.");
                }
            });
        }
        , minLength : 1
        , autoFocus : false
        , select : function(evt, ui) {
          //검색 부분 자동완성 키워드 url 뒤에 붙여서 전달
          link += ui.item.value;
          location.href=link;
          //----------
          //  console.log("전체 data: " + JSON.stringify(ui));
          //  console.log("db Index : " + ui.item.idx);
          //  console.log("검색 데이터 : " + ui.item.value);
        }
        , focus : function(evt, ui) {
            return false;
        }
        , close : function(evt) {
        }
    });

</script>

  </body>
</html>
