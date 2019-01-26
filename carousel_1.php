<script type="text/javascript">
	$(function(){
		var showcase = $("#showcase");

		showcase.Cloud9Carousel({
			yPos: 42,
			yRadius: 48,
			mirrorOptions: {
				gap: 12,
				height: 0.2
			},
			buttonLeft: $(".nav > .left"),
			buttonRight: $(".nav > .right"),
			autoPlay: true,
			bringToFront: true,
			onRendered: showcaseUpdated,
			onLoaded: function() {
				showcase.css( 'visibility', 'visible' )
				showcase.css( 'display', 'none' )
				showcase.fadeIn( 1500 )
			}
		});

		function showcaseUpdated( showcase ){
			var title = $('#item-title').html($(showcase.nearestItem()).attr( 'alt' ));

			var c = Math.cos((showcase.floatIndex() % 1) * 2 * Math.PI);
			title.css('opacity', 0.5 + (0.5 * c));
		}

			
		$('.nav > button').click( function( e ){
			var b = $(e.target).addClass( 'down' );
			setTimeout( function() { b.removeClass( 'down' ) }, 80 );
		});

		$(document).keydown( function( e ){
			switch( e.keyCode ) {
				case 37:
				$('.nav > .left').click();
				break

				case 39:
				$('.nav > .right').click();
			}
		});
	});
</script>

<div id="wrap">
		<div id="showcase" class="noselect">
			<?php 
			while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
				echo '
				<div class="cloud9-item">
					<img class="" src="subpages/categorias/'.$row['img'].'" style="width:300px; border:2px solid #5cb85c;">
					<h2 style="color:#000; position:absolute; bottom:0; right:0;"><span class="label label-success">'.$row['nombre'].'</span></h2>
				</div>
				';
			}
			?>
			<!--<div class="cloud9-item">
				<img class="" src="img/panaderia.jpg" style="width:400px; border:2px solid #5cb85c;">
				<h2 style="color:#000; position:absolute; bottom:0; right:0;"><span class="label label-success">PANADERÍAS</span></h2>
			</div>
			<img class="cloud9-item" src="img/2.png" alt="Wyzo"> 
			<img class="cloud9-item" src="img/3.png" alt="Opera"> 
			<img class="cloud9-item" src="img/4.png" alt="Chrome"> 
			<img class="cloud9-item" src="img/5.png" alt="Internet Explorer"> 
			<img class="cloud9-item" src="img/6.png" alt="Safari">-->
		</div>
		<p id="item-title">&nbsp;</p>
		<div class="nav" class="noselect">
			<button class="left">  ← </button>
			<button class="right"> → </button>
		</div>
	</div>
