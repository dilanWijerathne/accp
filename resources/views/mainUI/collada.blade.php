<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Collada Body</title>

	<!-- boostrap libraries-->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<!---->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/sequaPayStyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

	

	<script language="JavaScript">

	var accu_points=[];  // Selected accu points 

	function point_it(event){

	
		pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("pointer_div").offsetLeft;
		pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("pointer_div").offsetTop;
		document.getElementById("cross").style.left = (pos_x-1)+"px" ;
		document.getElementById("cross").style.top = (pos_y-15)+"px" ;
		document.getElementById("cross").style.visibility = "visible" ;
		document.pointform.form_x.value = pos_x;
		document.pointform.form_y.value = pos_y;

		accu_points.push(pos_x+"|"+pos_y);
	//	console.log(accu_points);

		alert("X: "+pos_x+" @ "+" Y: "+pos_y);
	}



	function treatLearn(){

		var i;
		for (i = 0; i < accu_points.length; i++) {
		    var point  = accu_points[i];
		    var axis =point.split("|");
		  
		    console.log(axis[1]);

		    var x=axis[0];
		    var y=axis[1];


		     $.ajax({
             url :  "accu_json_req",
             type: "GET",
             data : {'x': x, 'y': y, 'h': point},
             success: function(data)
             {
				if (data == "Data successfully saved") {
					
					set_points(355,400);
					//alert("Done");
				//	console.log(data);
                   	
               }
                else {
					
					alert("No data in the system");
				}
                                                                
               }
               }); 
		}


		
	}

	function treat(){

		var i;
		for (i = 0; i < accu_points.length; i++) {
		    var point  = accu_points[i];
		    var axis =point.split("|");
		  
		    console.log(axis[1]);

		    var x=axis[0];
		    var y=axis[1];


		     $.ajax({
             url : "read",        // "accu_json_req",
             type: "GET",
             data : {'x': x, 'y': y, 'h': point},
             success: function(data)
             {
	
						console.log(data);

                                                                
               }
               }); 
		}
//  770781947

		
	}


	function set_points(x,y){
		document.getElementById("cross-on-hand").style.left = (x-1)+"px" ;
		document.getElementById("cross-on-hand").style.top = (y-15)+"px" ;
		document.getElementById("cross-on-hand").style.visibility = "visible" ;
		document.pointform.form_x.value = x;
		document.pointform.form_y.value = y;
	}


	function get_accu_points(){
		 
	}

	</script>

	<style>
	#d{ position:absolute; width: 100%; text-align:center; margin:1em 0 -4.5em 0; z-index:1000; }
	#leftBar{float: left; margin-left: 10px;}
	#leftBarList{padding: 0; list-style-type: none;}
	.l-button{width: 120px;}
	</style>
</head>

<body>
<div class="col-md-12">
	<script src="collada/three.js"></script>
	<script src="collada/TrackballControls.js"></script>
	<script src="collada/ColladaLoader.js"></script>

	<!---->

	<div id="d">
		<div id="info">
			<P>AQSTES</p>
		</div>

		<div id="buttons_Aq" class="bwrap">
			<div id="leftBar">
				<ul id="leftBarList">
					<li><button class="btn btn-primary l-button" data-toggle="modal" data-target="#front_hand" data-whatever="@mdo" id="settings">Front Hand</button></li> <br>
					<li><button class="btn btn-primary l-button" data-toggle="modal" data-target="#front_hand" data-whatever="@mdo" id="settings">Inner Pain</button></li> <br>
					<li><button class="btn btn-primary l-button" data-toggle="modal" data-target="#front_hand" data-whatever="@mdo" id="settings">Pain</button></li> <br>
					<li><button class="btn btn-primary l-button" data-toggle="modal" data-target="#front_hand" data-whatever="@mdo" id="settings">Detection</button></li> <br>
					<li><button class="btn btn-primary l-button" data-toggle="modal" data-target="#front_hand" data-whatever="@mdo" id="settings">Report</button></li> <br>
				</ul>
			</div>
			<button class="btn btn-primary" data-toggle="modal" data-target="#Modal0" data-whatever="@mdo" id="settings">Digonosis</button>
			<button class="btn btn-primary" data-toggle="modal" data-target="#Modal1" data-whatever="@mdo" id="settings">Settings</button>
		</div>
	</div>
	<!---->

	<script>

		var control,camera,scene,renderer,width,height,asalogo,degree;
		width=window.innerWidth;
		height=window.innerHeight;
		degree=Math.PI/180;

		var collada=new THREE.ColladaLoader();
		collada.options.convertUpAxis=true;
		collada.load("collada/man.dae",function(object){
			
			asalogo=object.scene;
			asalogo.scale.set(20,20,20);  // body shape 
			asalogo.position.set(50,100,56);
			asalogo.rotation.set(0,2 * degree,0);
		//	console.log(collada);
			start();
			animate();

		});

		function start(){
			camera=new THREE.PerspectiveCamera(100,width/height,1,50000);
			camera.position.set(50,90,600);

			control=new THREE.TrackballControls(camera);
			control.addEventListener("change",render);

			scene=new THREE.Scene();

			var box=new THREE.Mesh(new THREE.CubeGeometry(200,100,100),new THREE.MeshLambertMaterial({color:"white"}));
			var ball=new THREE.Mesh(new THREE.SphereGeometry(100,20,20),new THREE.MeshBasicMaterial({color:"red",wireframe:true}));
			var plane=new THREE.Mesh(new THREE.PlaneGeometry(200,200),new THREE.MeshNormalMaterial({side:THREE.DoubleSide}));

			var light=new THREE.PointLight(0xffffff,1,9000);
			light.position.set(800,500,500);
			var light2=new THREE.PointLight(0xffffff,1,1000);
			light.position.set(500,500,400);

			var pointLight = new THREE.PointLight( 0xff0000, 1, 100 );
			pointLight.position.set( 30, 30, 30 );
			scene.add( pointLight );

			var sphereSize = 30;
			var pointLightHelper = new THREE.PointLightHelper( pointLight, sphereSize );
			scene.add( pointLightHelper );

			
			scene.add(light);
			scene.add(light2);
			scene.add(asalogo);


			renderer=new THREE.WebGLRenderer();
			renderer.setClearColor(0xffffff);
			renderer.setSize(width,height);
			document.body.appendChild(renderer.domElement);
			renderer.render(scene,camera);
		}

		function animate(){
			requestAnimationFrame(animate);
			control.update();
			console.log(animate);
		}

		function render(){
			renderer.render(scene,camera);
		}

	</script>

	
	<!-- Digonosis -->
	<div class="modal fade toggle_fonts" id="Modal0" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="ModalLabel"><i class="fa fa-users"> &nbsp;Dogonosis </i></h4>				
						<form name="pointform" method="post">
							<div id="pointer_div" onclick="point_it(event)" style = "background-image:url('images/girl.png');width:500px;height:900px;">
								<img src="images/point-icon.png" id="cross" style="position:relative;visibility:hidden;z-index:2;">
							</div>
							You pointed on x = <input id="x" type="text" name="form_x" size="4" /> - y = <input id="y" type="text" name="form_y" size="4" />
						</form> 
						<input type="button" value="treat" onclick="treat()">
				</div>
			</div>
		</div>
	</div>





	<!-- Font hand-->

	<!-- Front hand -->
	<div class="modal fade toggle_fonts" id="front_hand" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
		<div class="modal-dialog" role="document"  style="width: 80%; "  >
			<div class="modal-content" style="margin:0 auto; background:mediumslateblue">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="ModalLabel"><i class="fa fa-medkit"></i> &nbsp;Front hand </i></h4>
				</div>

				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group col-md-12" >
							<label for="message" class="control-label">Select limps on hand</label><br>
							<div class="col-md-8"   style = "background-image:url('images/front_hand.png');width:900px;height:600px;">
								<img src="images/point-icon.png" id="cross-on-hand" style="position:relative;visibility:hidden;z-index:2;">
							</div>
							<div class="col-md-4"><p for="message" class="control-label">Some description goes here with accu points </p></div>
						</div>
						<div class="modal-footer">
							
						</div>
					</form>
							<button type="button" class="btn btn-default" hover active data-dismiss="modal">No</button>
							<button type="submit" id ="btnLogout" name="logout" value="logout" class="btn btn-default">Yes</button>
				</div>
			</div>
		</div>
	</div>

	<!-- End of front hand -->
</div>

</body>
</html>
