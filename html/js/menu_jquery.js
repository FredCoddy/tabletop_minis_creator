/*
 * JUNG Frédéric  
 * Jquery et Three.js 
 * scrript pour créateur de personnage 
 * 15/05/18
 */


console.log("script Jquery : OK")

// var file_name = '<?php $_FILES['fichier']['name'] ?>';

// $("#get_filename").click(function(){
//     console.log("coucou");
//     var file_name = '<?php echo $file_name; ?>'; 
//     console.log(file_name);
// });

/* Menu jQuery */

$(window).on('wheel', function(e){
    /** 
     * Bind wheel mouse events for zoom and dezoom
     * Need to specify the max and min scale 
     *  
     * Increase or decrease the $scale of the object by $step
     * 
     * Need zoom()
     */
    var step = 0.05;
    var max_scale = 1.6;
    var min_scale = 0.5;
    var delta = e.originalEvent.deltaY;
    if(delta > 0 && scale > 0.5){ // Down
        scale-=step;
        zoom(scale);
    }
    else if(scale < max_scale){ // UP
        scale+=step;
        zoom(scale);
    }
})

$("#shark_button").click(function() {
    /**
     * Bind shark_button. Load the shark JSON object
     */
    remove_object();
    load_JSON('json_object/shark2.json', red);
    console.log("shark");
});

$("#elfe_button").click(function() {
    /**
     * Bind button. Load a Json model
     */
    remove_object();
    load_JSON('json_object/fighter_lady.json');
    console.log("lady");
});


$(".start_animation").click(function() {   
    render_rotate();
    $("#animation").addClass("pause").removeClass("start_animation");
    console.log("rotate");
});

$(".pause").click(function() {   
    render_noRotate();
    console.log("NoRotate");
    $("#animation").addClass("start_animation").removeClass("pause");
});

$(".color_button").click(function(){
    /**
     * 
     * Get the "color_button" id ans set this color as material.
     * 
     * Need to set the color name as element id in html script AND 
     * set the element class by "color_button"
     * 
     */
    // var name = $("#test").attr
    color=$(this).attr("id");
    def_color(color);
    load_JSON('json_object/shark2.json')
});


/**
 * 
 * @param {*} col : color name
 */
function def_color(col){
    
    coloR=col;
}

//COLOR NAME
var blue = 0x5A69ED;
var red = 0xF00019;
var green = 0x13E000;
var grey = 0x77767F;

var coloR = grey;


var scale = 0.7;




//=========================================================================================
// THRRE DOC : https://threejs.org/docs/index.html#manual/introduction/Creating-a-scene
// three.js

        //RENDERER
        var canvas = document.getElementById('canvas'); 

        var renderer = new THREE.WebGLRenderer({canvas: canvas});
        renderer.setClearColor(0xFFFFFF);
        renderer.setPixelRatio(window.devicePixelRatio);
        canvas.width  = canvas.clientWidth;
        canvas.height = canvas.clientHeight;
        renderer.setViewport(0, 0, canvas.clientWidth, canvas.clientHeight);
        // renderer.setSize(window.innerWidth, window.innerHeight);

        //CAMERA
        var camera = new THREE.PerspectiveCamera(35, window.innerWidth / window.innerHeight, 0.1, 3000);
        
        //CONTROLE TODO
        // var controls = new THREE.OrbitControls(camera);

        //SCENE
        var scene = new THREE.Scene();

        //LIGHTS
        var light = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(light);
        
        var light1 = new THREE.PointLight(0xffffff, 0.5);
        scene.add(light1);

        //MODEL 
    function load_JSON(objJSON){
        if (mesh){
            scene.remove(mesh);
        }
        var loader = new THREE.JSONLoader();
        loader.load(objJSON, handle_load);
    }

        var mesh;
        var mixer;

        //CONTROLS TODO
        // controls = new THREE.OrbitControls(camera, renderer.domElement);

    function handle_load(geometry, materials) {
        // CHANGE MATERIAL COLOR | PhongMaterial = aspect brillant
        var material = new THREE.MeshPhongMaterial({color:coloR});      
        mesh = new THREE.Mesh(geometry, material);
        scene.add(mesh);
        mesh.position.z = -10;
        mesh.position.y = -2;
        mesh.scale.set(scale,scale,scale);

    }


    function zoom(scale){
        mesh.scale.set(scale,scale,scale);
    }


        //REMOVE OBJECT

        /** Remove current object */
        function remove_object(){
            scene.remove(mesh);
        }

    // RENDER LOOP

    function render_noRotate() {
            if (mesh){
                mesh.rotation.y-=0.01;
            }
        renderer.render(scene, camera);
        requestAnimationFrame(render_noRotate);

    } 

    function render_rotate() {
        if (mesh) {
            mesh.rotation.y += 0.01;
            }
        renderer.render(scene, camera);
        requestAnimationFrame(render_rotate);
    }
    
    

        render_rotate()
        // requestAnimationFrame(render_noRotate);
        // controls.update();
        renderer.render(scene, camera);
        

       