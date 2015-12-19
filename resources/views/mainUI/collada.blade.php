<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Collada Body</title>

	<!-- boostrap libraries-->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<!-------->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/sequaPayStyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

	<script >
		
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

		<div id="buttons_materials" class="bwrap"></div>







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
			console.log(asalogo);
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

			//scene.add(box);
			//scene.add(ball);
			//scene.add(plane);
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
		}

		function render(){
			renderer.render(scene,camera);
		}





////



var mouse = {
    getIntersects: function( camera, sceneChildren, event ){
        event = event || window.event;

        var mouseX = ( event.clientX / window.innerWidth ) * 2 - 1;
        var mouseY = -( event.clientY / window.innerHeight ) * 2 + 1;

        var vector = new THREE.Vector3( mouseX, mouseY, camera.near );
            vector.unproject( camera );

        var raycaster = new THREE.Raycaster( camera.position, vector.sub( camera.position ).normalize() );

        var intersects = raycaster.intersectObjects( sceneChildren );

        if ( intersects.length > 0 ) {
            //console.log(intersects);
            return intersects;
        }
        return false;
    },

    Position3D: function(sceneChildren){
        var intersects = mouse.getIntersects( sceneChildren );
        return intersects[0].point
      //  alert(intersects[0].point);
    }
}



///

	</script>
	<!-- Digonosis -->
	<div class="modal fade toggle_fonts" id="Modal0" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="ModalLabel"><i class="fa fa-users"> &nbsp;Dogonosis </i></h4>
				</div>
				<div class="modal-body">

					<script type="text/javascript">
							
					</script>
				</div>
			</div>
		</div>
	</div>



	<!-- Settings -->
	<div class="modal fade toggle_fonts" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="ModalLabel"><i class="fa fa-users"> &nbsp;Setup this body </i></h4>
				</div>
				<div class="modal-body">

					<form action="#" method="post">
						<div class="form-group">
							<label for="message" class="control-label">Do You want to logout from sequapay ?</label>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" hover active data-dismiss="modal">No</button>
							<button type="submit" id ="btnLogout" name="logout" value="logout" class="btn btn-default"hover active ">Yes</button></div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- Settings -->
	<div class="modal fade toggle_fonts" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="ModalLabel"><i class="fa fa-users"> &nbsp;Logout </i></h4>
				</div>
				<div class="modal-body">

					<form action="#" method="post">
						<div class="form-group">
							<label for="message" class="control-label">Do You want to logout from sequapay ?</label>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" hover active data-dismiss="modal">No</button>
							<button type="submit" id ="btnLogout" name="logout" value="logout" class="btn btn-default"hover active ">Yes</button></div>
					</form>
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
							<div class="col-md-8"><img src="images/front_hand.png" width="600px" height="400px;"></div>
							<div class="col-md-4"><p for="message" class="control-label">Some description goes here with accu points </p></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" hover active data-dismiss="modal">No</button>
							<button type="submit" id ="btnLogout" name="logout" value="logout" class="btn btn-default"hover active ">Yes</button></div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- End of front hand -->
</div>

</body>
</html>
