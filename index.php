<!DOCTYPE html>
<html lang="en">
<head>
<title>UB North Campus Map Navigation</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<style>
body {
  margin: 0;
  height:100%;
  background-color: #D2E2F8;
}
iframe{
  float:left;
  width: 100%;
  top: 100px;
  height: 100%;
  position: fixed;
}

.header {
  background-color: #176BE2;
  padding: 8px;
  text-align: center;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  right: 0;
}
ul {
  position: fixed;
  right: 0;
  top:100px;
  list-style-type: none;
  margin-top: 50px;
  padding: 0;
  min-width: 10%;
  background-color: transparent;
  overflow: auto;
  text-align: center;
}
top {
  transform:translate(0px,95px);
  list-style-type: none;
  overflow: show;
  background-color: #173660;
  position: fixed;
  width: 100%;
  z-index: 1;
}
li {
  float: right;
  border-left:1px solid #bbb;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

.topnav .search-container input {
  padding: 10px 10px;
  margin-top: 3px;
  font-size: 17px;
  border: inset;
  opacity:0.9;
  display: block;
  margin-right: 3px;
}

.topnav .search-container button {
  padding: 10px 20px;
  margin-top: 3px;
  background: #176BE2;
  font-size: 17px;
  border: outset;
  cursor: pointer;
  opacity:0.9;
}

.topnav .search-container button:hover {
  background: #ccc;
}

#mapid {   
  /*display: flex;*/
  width: 100%;
  top: 90px;
  height: 100%;
  position: fixed;
  transform:translate(0px,45px);

}
</style>
</head>
<body>
<div class="header">
  <h1 style="color: White;">UB North Campus Map</h1>
</div>
<top>
  <li><a class="active" href="https://www-student.cse.buffalo.edu/CSE442-542/2020-spring/cse-442t/Contact">Contact Us</a></li>
  <li><a href="#about">About Us</a></li>
</top>

<div id="mapid"></div>

<ul>
<div class="topnav">
<div class="search-container">
    <form method ="POST" action="">
	  <input list="buildings" placeholder="Starting Location" name="start">
	  <input list="buildings" placeholder="Destination" name="dest">
	  	  <datalist id="buildings">
			<option value="Alfiero Center">
			<option value="Alumni Arena">
			<option value="Baird Hall">
			<option value="Baldy Hall">
			<option value="Bell Hall">
		    <option value="Bissell Hall">
			<option value="Bonner Hall">
		    <option value="Bookstore">
		    <option value="Capen Hall">
			<option value="Center for the Arts">
			<option value="Center for Tomorrow">
			<option value="Child Care Center">
			<option value="Clemens Hall">
			<option value="Commons">
			<option value="Cooke Hall">
			<option value="Davis Hall">
			<option value="Fronczak Hall">
			<option value="Hochstetter Hall">
			<option value="Jacobs Management Center">
			<option value="Jarvis Hall">
			<option value="Ketter Hall">
			<option value="Knox Lecture Hall">
			<option value="Lockwood Library">
			<option value="Mathematics Building">
			<option value="Natural Sciences Complex">
			<option value="Norton Hall">
			<option value="O’Brian Hall">
			<option value="Park Hall">
			<option value="Slee Hall">
			<option value="Student Union">
			<option value="Talbert Hall">
	    </datalist>
       <input type="submit" name="search" style="color: white;background:#176BE2;" value="Go!">
    </form>
	<?php
	$conn= mysqli_connect("tethys.cse.buffalo.edu:3306","yingyinl","50239602");
	$db=mysqli_select_db($conn,"yingyinl_db");

	if(isset($_POST['search'])){
		$name =$_POST['start'];
		$name2 =$_POST['dest'];
		$query="SELECT * FROM locations where name='$name'";
		$query_run=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($query_run)){
			?>
			<script>
				var str="<?php echo $row['name']?>"+": "+"<?php echo $row['lon']?>"+", "+"<?php echo $row['lat']?>";
				alert(str);
			
			</script>
			<?php
		}
	$query2="SELECT * FROM locations where name='$name2'";
		$query_run2=mysqli_query($conn,$query2);
		while($row=mysqli_fetch_array($query_run2)){
			?>
			<script>
				var str="<?php echo $row['name']?>"+": "+"<?php echo $row['lon']?>"+", "+"<?php echo $row['lat']?>";
				alert(str);
			
			</script>
			<?php
		}
	}
	?>
  </div>
  </div>
</ul>
<script>
 var cIcon = L.icon({
    iconUrl: 'current_mark.png',
    iconSize:     [38, 38], // size of the icon
    iconAnchor:   [0, 50], // point of the icon which will correspond to marker's location
    popupAnchor:  [19, -50] // point from which the popup should open relative to the iconAnchor
 });
 var map=L.map('mapid').setView([43.0007353,-78.7888962], 17);
    L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c']
    }).addTo( map );
	L.marker([43.00040,-78.78713],{icon: cIcon}).addTo(map).bindPopup("<b>Current Location</b>").openPopup();
</script>
</body>
</html>