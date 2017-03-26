<?php
/*
* this template file is for weixin statistics
*/
?>
<style type="text/css">
#allmap {width: 800px;height: 800px;}
#l-map{height:100%;width:100%;border-right:2px solid #bcbcbc;}
#r-result{height:100%;width:20%;float:left;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=cR3y3d2fjmsk4yR6bV3TiilS"></script>
<div id="allmap"></div>
<?php 
	$locations = get_weixin_user_locations();
//	dpm($user);
?>

<script type="text/javascript">
var map = new BMap.Map("allmap");
var point = new BMap.Point(106.404, 39.915);
map.centerAndZoom(point, 5);
map.addControl(new BMap.NavigationControl());  
map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}));
map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT, type: BMAP_NAVIGATION_CONTROL_PAN})); 
map.addControl(new BMap.NavigationControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, type: BMAP_NAVIGATION_CONTROL_ZOOM}));

function addMarker(point,uid){
  var marker = new BMap.Marker(point);
  map.addOverlay(marker);
//  alert(uid);
  var infoWindow1 = new BMap.InfoWindow(uid);
  marker.addEventListener("click", function(){this.openInfoWindow(infoWindow1);});
}

<?php
	foreach($locations as $location) {
		echo "var point = new BMap.Point(".$location['location_y'].",".$location['location_x'].");";
		$user = weixin_robot_get_user_info($location['open_user_id']);
//		dpm($user);
		echo "addMarker(point,'".$user['nickname']."');";
	}
?>
// var point = new BMap.Point(116.410538, 40.034286);
// addMarker(point);
</script>
