<!DOCTYPE html>
<html>
	<head>
		<?php include 'mainhead.php';?>
		<!--<link rel="stylesheet" type="text/css" href="/css/index.css"/>-->
		<title> Jozwald.com </title>
		<script src="lib/three.min.js"></script>
		<script>
			var prev = "follow";
			
			function jozwald(id)
			{
				document.getElementById(id).style="background-color:RGB(0,255,255);";
				if(prev != id)
				{
					document.getElementById(prev).style="background-color:RGB(80,80,80);";
					switch(id)
					{
						case ("hit"):
							document.getElementById("un").href="https://kipplex.com/";
							document.getElementById("deux").src="/Images/kipplex.png";
							break;
						case ("follow"):
							document.getElementById("un").href="https://www.instagram.com/lbljozwald.caption/";
							document.getElementById("deux").src="/Images/instagram.png";
							break;
						case ("dank"):
							document.getElementById("un").href="";
							document.getElementById("deux").src="/Images/dankmemes.gif";
							break;
						default:
							open("/500.php");
							close();
					}
					prev = id;
				}
			}
		</script>
		<style>
			body 
			{
				overflow: hidden;
			}
		</style>
		<body>
	</head>
	<body>
		<div id="main">
			<?php include 'main.php';?>
		</div>
		<div id="content">
			<script>
				var container;
				var camera, scene, renderer;
				var mesh, geometry, sphere;
				var mouseX = 0, mouseY = 0;
				var windowHalfX = window.innerWidth / 2;
				var windowHalfY = window.innerHeight / 2;
				document.addEventListener('mousemove', onDocumentMouseMove, false);
				init();
				animate();
				
				function c(geometry, material)
				{
					for ( var i = 0; i < 300; i ++ ) 
					{
						var mesh = new THREE.Mesh(geometry, material);
						mesh.position.x = Math.random() * 4000 - 2000;
						mesh.position.y = Math.random() * 4000 - 2000;
						mesh.position.z = Math.random() * 4000 - 2000;
						mesh.scale.x = mesh.scale.y = mesh.scale.z = Math.random() * 4 + 2;
						scene.add(mesh);
					}
				}
				
				function init() 
				{
					container = document.createElement('div');
					document.body.appendChild(container);
					camera = new THREE.PerspectiveCamera(40, window.innerWidth / window.innerHeight, 1, 15000);
					camera.position.z = 3200;
					scene = new THREE.Scene();
					sphere = new THREE.Mesh( new THREE.SphereGeometry(100, 20, 20), new THREE.MeshBasicMaterial({map: new THREE.TextureLoader().load('pepe.png')}));
					scene.add(sphere);
					var geometry = new THREE.IcosahedronGeometry(15, 0);
					geometry.rotateX(Math.PI / 2 );
					var material = new THREE.MeshNormalMaterial();
					c(geometry, material);
					geometry = new THREE.TorusKnotGeometry(10, 3, 100, 16);
					geometry.rotateX(Math.PI / 2 );
					c(geometry, material);
					geometry = new THREE.CylinderGeometry(0, 10, 100, 10);
					geometry.rotateX(Math.PI / 2 );
					c(geometry, material);
					geometry = new THREE.TorusGeometry(10, 3, 16, 100);
					geometry.rotateX(Math.PI / 2 );
					c(geometry, material);
					scene.matrixAutoUpdate = false;
					renderer = new THREE.WebGLRenderer({antialias: true});
					renderer.setClearColor(0xffffff);
					renderer.setPixelRatio(window.devicePixelRatio);
					renderer.setSize(window.innerWidth, window.innerHeight);
					renderer.sortObjects = false;
					container.appendChild(renderer.domElement);
					window.addEventListener('resize', onWindowResize, false);
				}

				function onWindowResize() 
				{
					windowHalfX = window.innerWidth / 2;
					windowHalfY = window.innerHeight / 2;
					camera.aspect = window.innerWidth / window.innerHeight;
					camera.updateProjectionMatrix();
					renderer.setSize( window.innerWidth, window.innerHeight );
				}

				function onDocumentMouseMove(event) 
				{
					mouseX = (event.clientX - windowHalfX) * 10;
					mouseY = (event.clientY - windowHalfY) * 10;
				}

				function animate() 
				{
					requestAnimationFrame(animate);
					render();
				}

				function render() 
				{
					var time = Date.now() * 0.0005;
					sphere.position.x = Math.sin(time * 0.7) * 2000;
					sphere.position.y = Math.cos(time * 0.5) * 2000;
					sphere.position.z = Math.cos(time * 0.3) * 2000;
					sphere.rotation.y = time;
					for (var i = 1, l = scene.children.length; i < l; i ++) 
					{
						scene.children[i].lookAt(sphere.position);
					}
					camera.position.x += (mouseX - camera.position.x) * .05;
					camera.position.y += (- mouseY - camera.position.y) * .05;
					camera.lookAt(scene.position);
					renderer.render(scene, camera);
				}
			</script>
		</div>
	</body>
</html>
