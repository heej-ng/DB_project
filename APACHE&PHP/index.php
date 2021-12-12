<!DOCTYPE html>
<html lang="ko">
<head>
<title>구글지도사용하기</title>
<meta charset = 'utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyD8y-VoNRWbuLhKy5QLdUvxhxROqtdZHZc">//키를 발급받아 사용하세요</script>
<style>

#map_ma {width:100%; height:800px; clear:both; border:solid 1px red;}
</style>
</head>병원
<body>
<div id="map_ma"></div>
<script type="text/javascript">
      $(document).ready(function() {
         var myLatlng = new google.maps.LatLng(35.837143,128.55861); // 위치값 위도 경도
   //var Y_point         = 35.837143;      // Y 좌표
   //var X_point         = 128.558612;      // X 좌표
   var temp = location.href.split("?");
   var data = temp[1].split("/");
   var X_point = data[0];// 위도
   var Y_point = data[1]; // 경도
   var name = data[2];

   console.log(X_point);
   console.log(Y_point);
   console.log(name);
   var zoomLevel      = 18;            // 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼
   var markerTitle      = "대구광역시";      // 현재 위치 마커에 마우스를 오버을때 나타나는 정보
   var markerMaxWidth   = 300;            // 마커를 클릭했을때 나타나는 말풍선의 최대 크기

// 말풍선 내용
   var contentString   = '<div>' +
   '<h2>'+name+'</h2>'+
   '<p>'+'검색하신 병원은 '+name+' 입니다'+'</p>' +

   '</div>';
   var myLatlng = new google.maps.LatLng(X_point, Y_point);
   var mapOptions = {
                  zoom: zoomLevel,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
               }
   var map = new google.maps.Map(document.getElementById('map_ma'), mapOptions);
   var marker = new google.maps.Marker({
                                 position: myLatlng,
                                 map: map,
                                 title: markerTitle
   });
   var infowindow = new google.maps.InfoWindow(
                                    {
                                       content: contentString,
                                       maxWizzzdth: markerMaxWidth
                                    }
         );
   google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
   });
});
      </script>
</body>
</html>