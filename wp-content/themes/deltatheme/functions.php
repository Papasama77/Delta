<?php
    function styles_complementaires(){

        // Style.css
        wp_enqueue_style('polices-google','https://fonts.googleapis.com/css2?family=Open+Sans&family=Unica+One&display=swap');

        wp_enqueue_style('style-global', get_stylesheet_directory_uri().'/css/global.css');

        wp_enqueue_style('style-woocommerce',get_stylesheet_directory_uri().'/css/woocommerce.css');

        wp_enqueue_style('style-responsive',get_stylesheet_directory_uri().'/css/responsive.css');

        // Scripts
        
}

add_action('wp_enqueue_scripts','styles_complementaires');

//INITILISATION DES MENUS

if(function_exists('register_nav_menus')){
    register_nav_menus(
        array(
            'main'=>'Menu Principal',
            'topbar'=>'Top Bar Menu',
            'footmenu'=>'Menu dans le footer',
            'secondaire'=>'Menu pages secondaires'
            )
        );
}

/*
  Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/*Pour que le menu deroulant fonctionne avec bootstrap 5*/

add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}


//INITIALISATION DES WIDGETS
function theme_sidebar(){

if(function_exists('register_sidebar')){
    register_sidebar(
        array(
            'id'=>'premier',
            'name'=>'Colonne de gauche',
            'description'=>'emplacement se trouvant à gauche sur les pages secondaires',
            'before_widget'=>'<div>',
            'after_widget'=>'</div>'
            )
        );
}

if(function_exists('register_sidebar')){
    register_sidebar(
        array(
            'id'=>'deux',
            'name'=>'Colonne de droite',
            'description'=>'emplacement se trouvant à gauche sur les pages secondaires',
            'before_widget'=>'<div>',
            'after_widget'=>'</div>'
            )
        );
}

if(function_exists('register_sidebar')){
    register_sidebar(
        array(
            'id'=>'trois',
            'name'=>'footer',
            'description'=>'emplacement se trouvant dans le footer',
            'before_widget'=>'<div>',
            'after_widget'=>'</div>'
            )
        );
}
}

add_action('widgets_init','theme_sidebar');

//Ajouter la personnalisation du theme

//add_theme_support($custom,$arg)

function theme_setup(){
//1 - post-formats
add_theme_support('post-formats', array('aside','gallery','quote','image','link','status','video','audio'));

//2 - post-thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(800,300,true);



//3 - custom-background
$arg=array(
    'default-color'=>'f1f1f1',
    'default-image'=>'',
    'default-repeat'=>'repeat',
    'default-position'=>'left',
    'wqp-head-callback'=>'_custom_background_cb'
);

add_theme_support('custom-background',$arg);

//4 - custom-header
$entete=array(
    'default-image'=>'',
    'random-default'=>false,
    'width'=>1200,
    'height'=>400,
    'flex-height'=>false,
    'flex-width'=>false,
    'default-text-color'=>'ff0000',
    'header-text'=>true,
    'uploads'=>true
);

add_theme_support('custom-header',$entete);
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );

}
add_action('after_setup_theme','theme_setup');

//PERSONNALISATION DU THEME
function theme_customize_register($wp_customize){

//creer la section pour les parametres généraux
    $wp_customize->add_section('ma_section',array(
        'title'=>'Parametres generaux',
        'description'=>'Description de mon theme',
        'priority'=>100
    ));

//afficher ou non le titre des pages et des articles
    //reglage
        $wp_customize->add_setting('active_title',array('default'=>'title','sanitize_callback'=>'esc_attr'));
    
    //controle
        $wp_customize->add_control('active_title',array(
            'label'=>'Activer ou desactiver le titre des pages et articles',
            'section'=>'ma_section',
            'settings'=>'active_title',
            'type'=>'select',
            'choices'=>array(
                    'title'=>'Afficher le titre',
                    'hidden'=>'Désactiver le titre'
            )));
            
//selecteur de couleur
    //1 - Ajout du reglage
        $wp_customize->add_setting('color_liens',array(
            'default'=>'#000',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //2 - Ajout du controle selecteur de couleur
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'link_color',array(
            'label'=>'Couleur des liens',
            'section'=>"ma_section",
            'settings'=>'color_liens'
        )));


//Couleur du texte
    //ajout du reglage
        $wp_customize->add_setting('color_text',array(
            'default'=>'#ffffff',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'color_txt',array(
            'label'=>'Couleur du texte',
            'section'=>"ma_section",
            'settings'=>'color_text'
        )));


//image de fond
    //reglage
    $wp_customize->add_setting('bg_site',array('sanitize_callback'=>'esc_attr'));

    //controle
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'background_site',array(
        'label'=>'Fond du site',
        'section'=>'ma_section',
        'settings'=>'bg_site'
    )));

//Couleur du background
    //ajout du reglage
        $wp_customize->add_setting('color_background',array(
            'default'=>'#ffffff',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //ajout du controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'color_bg',array(
            'label'=>'Couleur du background',
            'section'=>"ma_section",
            'settings'=>'color_background'
        )));

//Positon de l'image/background-position
    //reglage
        $wp_customize->add_setting('background-position',array(
            'default'=>'center center', 
            'sanitize_callback'=>'esc_attr' 
        ));
    //controle
        $wp_customize->add_control('background-position',array(
            'label'=>'Position de l\'image de fond',
            'section'=>'ma_section',
            'settings'=>'background-position',
            'type'=>'select',
            'choices'=>array(
                'left top'=>'haut à gauche',
                'left bottom'=>'centre à gauche',
                'center center'=>'au centre',
                'right top'=>'haut à droite',
                'right bottom'=>'centre à droite'
            )));

//Taille de l'image/background-size
    //reglage
        $wp_customize->add_setting('background-size',array(
            'default'=>'auto',
            'sanitize_callback'=>'esc_attr' 
        ));

    //controle
        $wp_customize->add_control('background-size',array(
            'label'=>'Taille de l\'image de fond',
            'section'=>'ma_section',
            'settings'=>'background-size',
            'type'=>'select',
            'choices'=>array(
                'auto'=>'automatique',
                'contain'=>'contenu dans son container',
                'cover'=>'étalement sur toute la largeur et hauteur'
            )));

//background-attachment/scroll ou fixed
    //reglage
        $wp_customize->add_setting('background-attachment',array(
            'default'=>'scroll', 
            'sanitize_callback'=>'esc_attr' 
        ));

    //controle
        $wp_customize->add_control('background-attachment',array(
            'label'=>'BG scroll ou fixe',
            'section'=>'ma_section',
            'settings'=>'background-attachment',
            'type'=>'select',
            'choices'=>array(
                'scroll'=>'defilement',
                'fixed'=>'fixe'
            )
        ));

//background-repeat
    //reglage
        $wp_customize->add_setting('background-repeat',array(
            'default'=>'repeat', 
            'sanitize_callback'=>'esc_attr' 
        ));

    //controle
        $wp_customize->add_control('background-repeat',array(
            'label'=>'BG repeat ou no-repeat',
            'section'=>'ma_section',
            'settings'=>'background-repeat',
            'type'=>'select',
            'choices'=>array(
                'repeat'=>'répéter',
                'no-repeat'=>'ne pas répéter',
                'repeat-x'=>'répéter sur l\'horizontal',
                'repeat-y'=>'répéter sur la verticale',
            )
        ));

//Fullwidth or Boxed du site
    // Container ou container-fluid (bootstrap)
        //reglage
            $wp_customize->add_setting('largeur_site',array('default'=>'container','sanitize_callback'=>'esc_attr'));

        //controle
            $wp_customize->add_control('largeur_site',array(
                'label'=>'largeur du site : Fullwidth ou Boxed',
                'section'=>'ma_section',
                'type'=>'select',
                'choices'=>array(
                    'container'=>'Boxed',
                    'container-fluid'=>'Fullwidth'
                )));

//TOPBAR
    //Creation d'un nouvelle section
        $wp_customize->add_section('section_topbar',array(
            'title'=>'Parametres Topbar',
            'description'=>'Personnalisation topbar',
            'priority'=>105
        ));

    // Activer ou desactiver la topbar
        //reglage
        $wp_customize->add_setting('active_topbar',array('default'=>'top-bar','sanitize_callback'=>'esc_attr'));

            //controle
        $wp_customize->add_control('active-tb',array(
            'label'=>'Activer ou desactiver la Topbar',
            'section'=>'section_topbar',
            'settings'=>'active_topbar',
            'type'=>'select',
            'choices'=>array(
                'top-bar'=>'Topbar affichée',
                'hidden'=>'Topbar cachée'
            )
        ));

//Couleur background topbar
    //reglage
        $wp_customize->add_setting('topbar_background',array(
            'default'=>'#000000',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'topbar_bg',array(
            'label'=>'couleur de fond topbar',
            'section'=>'section_topbar',
            'settings'=>'topbar_background'
        )));

// couleur texte topbar
     //reglage
        $wp_customize->add_setting('topbar_text',array(
            'default'=>'#000000',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'topbar_txt',array(
            'label'=>'couleur du texte',
            'section'=>'section_topbar',
            'settings'=>'topbar_text'
        )));

//couleur des liens topbar
     //reglage
        $wp_customize->add_setting('topbar_link',array(
            'default'=>'#e9d7e8',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tb_link',array(
            'label'=>'couleur des liens',
            'section'=>'section_topbar',
            'settings'=>'topbar_link'
        )));

//Numero de telephone:(champ texte)
    //reglage
        $wp_customize->add_setting('phone_number',array('default'=>'+33(0) 12 434 434','sanitize_callback'=>'esc_html'));

    //controle
        $wp_customize->add_control('phone-nb',array(
            'label'=>'Texte à ajouter dans la topbar',
            'section'=>'section_topbar',
            'settings'=>'phone_number',
            'type'=>'text'
        ));
//case a cocher pour afficher le texte
    //reglage
        $wp_customize->add_setting('display_phone_number',array('sanitize_callback'=>'esc_html'));

    //controle
        $wp_customize->add_control('display_phone',array(
            'label'=>'Afficher le texte dans la topbar',
            'section'=>'section_topbar',
            'settings'=>'display_phone_number',
            'type'=>'checkbox'
        ));

//FIN TOPBAR

//********** HEADER **************/

$wp_customize->add_section('section_header',array(
    'title'=>'Header',
    'description'=>'Parametre du header,logo, menu, réseaux sociaux',
    'priority'=>110
));

//Logo
    //reglage
    $wp_customize->add_setting('logo_site',array('sanitize_callback'=>'esc_attr'));

    //controle
    $wp_customize->add_control(new WP_customize_Image_Control($wp_customize,'logo_site',array(
        'label'=>'Chargez votre logo',
        'section'=>'section_header',
        'settings'=>'logo_site'
    )));


//Placement des elements avec flex
//Reseaux Sociaux
    //reglage
        $wp_customize->add_setting('justify_content_header',array('default'=>'space-around','sanitize_callback'=>'esc_attr'));
    
    //controle
        $wp_customize->add_control('justify-header',array(
            'label'=>'choisir un positionnement horizontal des elements',
            'section'=>'section_header',
            'settings'=>'justify_content_header',
            'type'=>'select',
            'choices'=>array(
                'flex-start'=>'gauche',
                'flex-end'=>'droite',
                'center'=>'au centre',
                'space-around'=>'espaces autour',
                'space-between'=>'espaces entre'
            )));

//Image de fond du header

    // couleur texte header
    //reglage
        $wp_customize->add_setting('header_text',array(
            'default'=>'#000000',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'header_txt',array(
            'label'=>'couleur du texte',
            'section'=>'section_header',
            'settings'=>'header_text'
        )));

    //couleur des liens topbar
     //reglage
     $wp_customize->add_setting('header_link',array(
        'default'=>'#d95370',
        'sanitize_callback'=>'sanitize_hex_color',
        'capability'=>'edit_theme_options',
        'type'=>'theme_mod',
        'transport'=>'refresh'
    ));

    //controle
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'header_link',array(
        'label'=>'couleur des liens',
        'section'=>'section_header',
        'settings'=>'header_link'
    )));

// chargement de l'image
    //reglage
        $wp_customize->add_setting('header_site',array('sanitize_callback'=>'esc_attr'));

    //controle
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'header_site',array(
        'label'=>'Fond du header',
        'section'=>'section_header',
        'settings'=>'header_site'
        )));

//Couleur du background
    //reglage
    $wp_customize->add_setting('color_background_header',array(
        'default'=>'#ffffff',
        'sanitize_callback'=>'sanitize_hex_color',
        'capability'=>'edit_theme_options',
        'type'=>'theme_mod',
        'transport'=>'refresh'
    ));

//controle
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'color_bg_header',array(
        'label'=>'Couleur du background',
        'section'=>"section_header",
        'settings'=>'color_background_header'
    )));

//Repeat
    //reglage
        $wp_customize->add_setting('header-repeat',array(
        'default'=>'repeat',
        'sanitize_callback'=>'esc_attr'  
        ));

    //controle
        $wp_customize->add_control('header-repeat',array(
        'label'=>'header repeat ou no-repeat',
        'section'=>'section_header',
        'settings'=>'header-repeat',
        'type'=>'select',
        'choices'=>array(
            'repeat'=>'répéter',
            'no-repeat'=>'ne pas répéter',
            'repeat-x'=>'répéter sur l\'horizontal',
            'repeat-y'=>'répéter sur la verticale',
        )));

//Position
       //reglage
       $wp_customize->add_setting('header-position',array(
        'default'=>'center center',  
        'sanitize_callback'=>'esc_attr'
        ));

    //controle
        $wp_customize->add_control('header-position',array(
        'label'=>'Position de l\'image de fond',
        'section'=>'section_header',
        'settings'=>'header-position',
        'type'=>'select',
        'choices'=>array(
            'left top'=>'haut à gauche',
            'left bottom'=>'centre à gauche',
            'center center'=>'au centre',
            'right top'=>'haut à droite',
            'right bottom'=>'centre à droite'
        )));

//Taille
    //reglage
        $wp_customize->add_setting('header-size',array(
            'default'=>'auto', 
            'sanitize_callback'=>'esc_attr' 
        ));
    
    //controle
        $wp_customize->add_control('header-size',array(
        'label'=>'Taille de l\'image de fond',
        'section'=>'section_header',
        'settings'=>'header-size',
        'type'=>'select',
        'choices'=>array(
            'auto'=>'automatique',
            'contain'=>'contenu dans son container',
            'cover'=>'étalement sur toute la largeur et hauteur'
        )));

    //reglage
        $wp_customize->add_setting('align_items_header',array('default'=>'center','sanitize_callback'=>'esc_attr'));
    
    //controle
        $wp_customize->add_control('align-header',array(
        'label'=>'choisir un positionnement horizontal des elements',
        'section'=>'section_header',
        'settings'=>'align_items_header',
        'type'=>'select',
        'choices'=>array(
            'flex-start'=>'haut',
            'flex-end'=>'bas',
            'center'=>'au centre',
            'baseline'=>'à la base' 
        )));

//FIN DU HEADER

//********** BOTTOM **************/

$wp_customize->add_section('section_bottom',array(
    'title'=>'Bottom',
    'description'=>'Parametre du bottom,logo, menu, réseaux sociaux',
    'priority'=>115
));

//Logo
    //reglage
        $wp_customize->add_setting('logo_site',array('sanitize_callback'=>'esc_attr'));

    //controle
        $wp_customize->add_control(new WP_customize_Image_Control($wp_customize,'logo_site',array(
        'label'=>'Chargez votre logo',
        'section'=>'section_bottom',
        'settings'=>'logo_site'
    )));

//Placement des elements avec flex
    //Reseaux Sociaux
        //reglage
            $wp_customize->add_setting('justify_content_bottom',array('default'=>'space-around','sanitize_callback'=>'esc_attr'));
    
        //controle
            $wp_customize->add_control('justify-bottom',array(
            'label'=>'choisir un positionnement horizontal des elements',
            'section'=>'section_bottom',
            'settings'=>'justify_content_bottom',
            'type'=>'select',
            'choices'=>array(
                'flex-start'=>'gauche',
                'flex-end'=>'droite',
                'center'=>'au centre',
                'space-around'=>'espaces autour',
                'space-between'=>'espaces entre'
            )));

//Image de fond du bottom

    // couleur texte bottom
    //reglage
        $wp_customize->add_setting('bottom_text',array(
            'default'=>'#000000',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'bottom_txt',array(
            'label'=>'couleur du texte',
            'section'=>'section_bottom',
            'settings'=>'bottom_text'
        )));

    //couleur des liens 
     //reglage
     $wp_customize->add_setting('bottom_link',array(
        'default'=>'#d95370',
        'sanitize_callback'=>'sanitize_hex_color',
        'capability'=>'edit_theme_options',
        'type'=>'theme_mod',
        'transport'=>'refresh'
    ));

    //controle
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'bottom_link',array(
        'label'=>'couleur des liens',
        'section'=>'section_bottom',
        'settings'=>'bottom_link'
    )));

// chargement de l'image
    //reglage
        $wp_customize->add_setting('bottom_site',array('sanitize_callback'=>'esc_attr'));

    //controle
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'bottom_site',array(
        'label'=>'Fond du bottom',
        'section'=>'section_bottom',
        'settings'=>'bottom_site'
        )));

//Couleur du background
    //reglage
    $wp_customize->add_setting('color_background_bottom',array(
        'default'=>'#ffffff',
        'sanitize_callback'=>'sanitize_hex_color',
        'capability'=>'edit_theme_options',
        'type'=>'theme_mod',
        'transport'=>'refresh'
    ));

//controle
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'color_bg_bottom',array(
        'label'=>'Couleur du background',
        'section'=>'section_bottom',
        'settings'=>'color_background_bottom'
    )));

//Repeat
    //reglage
        $wp_customize->add_setting('bottom-repeat',array(
        'default'=>'repeat',
        'sanitize_callback'=>'esc_attr'  
        ));

    //controle
        $wp_customize->add_control('bottom-repeat',array(
        'label'=>'bottom repeat ou no-repeat',
        'section'=>'section_bottom',
        'settings'=>'bottom-repeat',
        'type'=>'select',
        'choices'=>array(
            'repeat'=>'répéter',
            'no-repeat'=>'ne pas répéter',
            'repeat-x'=>'répéter sur l\'horizontal',
            'repeat-y'=>'répéter sur la verticale',
        )));

//Position
       //reglage
       $wp_customize->add_setting('bottom-position',array(
        'default'=>'center center', 
        'sanitize_callback'=>'esc_attr'
        ));

    //controle
        $wp_customize->add_control('bottom-position',array(
        'label'=>'Position de l\'image de fond',
        'section'=>'section_bottom',
        'settings'=>'bottom-position',
        'type'=>'select',
        'choices'=>array(
            'left top'=>'haut à gauche',
            'left bottom'=>'centre à gauche',
            'center center'=>'au centre',
            'right top'=>'haut à droite',
            'right bottom'=>'centre à droite',
            'top center'=>'en haut au centre',
            'bottom center'=>'en bas au centre'
        )));

//Taille
    //reglage
        $wp_customize->add_setting('bottom-size',array(
            'default'=>'auto', 
            'sanitize_callback'=>'esc_attr' 
        ));
    
    //controle
        $wp_customize->add_control('bottom-size',array(
        'label'=>'Taille de l\'image de fond',
        'section'=>'section_bottom',
        'settings'=>'bottom-size',
        'type'=>'select',
        'choices'=>array(
            'auto'=>'automatique',
            'contain'=>'contenu dans son container',
            'cover'=>'étalement sur toute la largeur et hauteur'
        )));

    //reglage
        $wp_customize->add_setting('align_items_bottom',array('default'=>'center','sanitize_callback'=>'esc_attr'));
    
    //controle
        $wp_customize->add_control('align-header',array(
        'label'=>'choisir un positionnement horizontal des elements',
        'section'=>'section_bottom',
        'settings'=>'align_items_bottom',
        'type'=>'select',
        'choices'=>array(
            'flex-start'=>'haut',
            'flex-end'=>'bas',
            'center'=>'au centre',
            'baseline'=>'à la base' 
        )));

//FIN DU BOTTOM


//********** FOOTER **************/

    $wp_customize->add_section('section_footer',array(
    'title'=>'footer',
    'description'=>'Parametre du footer,logo, menu, réseaux sociaux',
    'priority'=>120
    ));

//Logo
    //reglage
    $wp_customize->add_setting('logo_site',array('sanitize_callback'=>'esc_attr'));

    //controle
    $wp_customize->add_control(new WP_customize_Image_Control($wp_customize,'logo_site',array(
        'label'=>'Chargez votre logo',
        'section'=>'section_footer',
        'settings'=>'logo_site'
    )));


//Placement des elements avec flex
//Reseaux Sociaux
    //reglage
        $wp_customize->add_setting('justify_content_footer',array('default'=>'space-around','sanitize_callback'=>'esc_attr'));
    
    //controle
        $wp_customize->add_control('justify-footer',array(
            'label'=>'choisir un positionnement horizontal des elements',
            'section'=>'section_footer',
            'settings'=>'justify_content_footer',
            'type'=>'select',
            'choices'=>array(
                'flex-start'=>'gauche',
                'flex-end'=>'droite',
                'center'=>'au centre',
                'space-around'=>'espaces autour',
                'space-between'=>'espaces entre'
            )));

//Image de fond du footer
    // couleur texte footer
    //reglage
        $wp_customize->add_setting('footer_text',array(
            'default'=>'#000000',
            'sanitize_callback'=>'sanitize_hex_color',
            'capability'=>'edit_theme_options',
            'type'=>'theme_mod',
            'transport'=>'refresh'
        ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_txt',array(
            'label'=>'couleur du texte',
            'section'=>'section_footer',
            'settings'=>'footer_text'
        )));

    //couleur des liens 
     //reglage
        $wp_customize->add_setting('footer_link',array(
        'default'=>'#d95370',
        'sanitize_callback'=>'sanitize_hex_color',
        'capability'=>'edit_theme_options',
        'type'=>'theme_mod',
        'transport'=>'refresh'
    ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_link',array(
        'label'=>'couleur des liens',
        'section'=>'section_footer',
        'settings'=>'footer_link'
    )));

// chargement de l'image
    //reglage
        $wp_customize->add_setting('footer_site',array('sanitize_callback'=>'esc_attr'));

    //controle
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'footer_site',array(
        'label'=>'Fond du footer',
        'section'=>'section_footer',
        'settings'=>'footer_site'
        )));

//Couleur du background
    //reglage
        $wp_customize->add_setting('color_background_footer',array(
        'default'=>'#ffffff',
        'sanitize_callback'=>'sanitize_hex_color',
        'capability'=>'edit_theme_options',
        'type'=>'theme_mod',
        'transport'=>'refresh'
    ));

    //controle
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'color_bg_footer',array(
        'label'=>'Couleur du background',
        'section'=>'section_footer',
        'settings'=>'color_background_footer'
    )));

//Repeat
    //reglage
        $wp_customize->add_setting('footer-repeat',array(
        'default'=>'repeat', 
        'sanitize_callback'=>'esc_attr' 
        ));

    //controle
        $wp_customize->add_control('footer-repeat',array(
        'label'=>'footer repeat ou no-repeat',
        'section'=>'section_footer',
        'settings'=>'footer-repeat',
        'type'=>'select',
        'choices'=>array(
            'repeat'=>'répéter',
            'no-repeat'=>'ne pas répéter',
            'repeat-x'=>'répéter sur l\'horizontal',
            'repeat-y'=>'répéter sur la verticale',
        )));

//Position
       //reglage
       $wp_customize->add_setting('footer-position',array(
        'default'=>'center center', 
        'sanitize_callback'=>'esc_attr' 
        ));

    //controle
        $wp_customize->add_control('footer-position',array(
        'label'=>'Position de l\'image de fond',
        'section'=>'section_footer',
        'settings'=>'footer-position',
        'type'=>'select',
        'choices'=>array(
            'left top'=>'haut à gauche',
            'left bottom'=>'centre à gauche',
            'center center'=>'au centre',
            'right top'=>'haut à droite',
            'right bottom'=>'centre à droite',
            'top center'=>'en haut au centre',
            'bottom center'=>'en bas au centre'
        )));

//Taille
    //reglage
        $wp_customize->add_setting('footer-size',array(
            'default'=>'auto',  
            'sanitize_callback'=>'esc_attr'
        ));
    
    //controle
        $wp_customize->add_control('footer-size',array(
        'label'=>'Taille de l\'image de fond',
        'section'=>'section_footer',
        'settings'=>'footer-size',
        'type'=>'select',
        'choices'=>array(
            'auto'=>'automatique',
            'contain'=>'contenu dans son container',
            'cover'=>'étalement sur toute la largeur et hauteur'
        )));

    //reglage
        $wp_customize->add_setting('align_items_footer',array('default'=>'center','sanitize_callback'=>'esc_attr'));
    
    //controle
        $wp_customize->add_control('align-footer',array(
        'label'=>'choisir un positionnement horizontal des elements',
        'section'=>'section_footer',
        'settings'=>'align_items_footer',
        'type'=>'select',
        'choices'=>array(
            'flex-start'=>'haut',
            'flex-end'=>'bas',
            'center'=>'au centre',
            'baseline'=>'à la base' 
        )));

//Copyright : (Champ texte)
    //reglage
        $wp_customize->add_setting('copyright',array(
          'default'=>'copyright 2023 - Tous droits réservés','sanitize_callback'=>'esc_html'  
        ));

    //controle
        $wp_customize->add_control('copyright-footer',array(
            'label'=>'Texte à ajouter dans le footer',
            'section'=>'section_footer',
            'settings'=>'copyright',
            'type'=>'text'
        ));

    }
//FIN DU FOOTER}

add_action('customize_register','theme_customize_register');

function theme_customize_css(){
    //appliquer les parametres sur le css
?>
    <style type="text/css">
        a{color:<?php echo esc_attr(get_theme_mod('color_liens','#000000'));?>;}

    /*Couleur background*/
        body{background-color:<?php echo esc_attr(get_theme_mod('color_background','#ffffff'));?>;
        
        color:<?php echo esc_attr(get_theme_mod('color_text','#000000'));?>;
        
        background-image:url(<?php echo esc_attr(get_theme_mod('bg_site','none'));?>);
        
        background-position:<?php echo esc_attr(get_theme_mod('background-position','center center'));?>;
       
        background-repeat:<?php echo esc_attr(get_theme_mod('background-repeat','repeat'));?>;
        
        background-attachment:<?php echo esc_attr(get_theme_mod('background-attachment','scroll'));?>;
       
        background-size:<?php echo esc_attr(get_theme_mod('background-size','auto'));?>;
        }

        #topbar{background-color:<?php echo esc_attr(get_theme_mod('topbar_background','#000000'));?>;
        
        color:<?php echo esc_attr(get_theme_mod('topbar_text','#ffffff')); ?>;}

        #topbar a{color:<?php echo esc_attr(get_theme_mod('topbar_link','#e9d7e8'));?>;}


        header{justify-content:<?php echo esc_attr(get_theme_mod('justify_content_header','space-around'));?>;
        
        background-image:url(<?php echo esc_attr(get_theme_mod('header_site','none'));?>);

        background-color:<?php echo esc_attr(get_theme_mod('color_background_header','#ffffff'));?>;

        color:<?php echo esc_attr(get_theme_mod('header_text','#000000'));?>;

        background-repeat:<?php echo esc_attr(get_theme_mod('header-repeat','repeat'));?>;

        background-position:<?php echo esc_attr(get_theme_mod('header-position','center center'));?>;

        background-size:<?php echo esc_attr(get_theme_mod('header-size','auto'));?>;

        align-items:<?php echo esc_attr(get_theme_mod('align_items_header','center'));?>;
        }

        header a{color:<?php echo esc_attr(get_theme_mod('header_link','#d95370'));?>;}


        .bottom{justify-content:<?php echo esc_attr(get_theme_mod('justify_content_bottom','space-around'));?>;
        
        background-image:url(<?php echo esc_attr(get_theme_mod('bottom_site','none'));?>);

        background-color:<?php echo esc_attr(get_theme_mod('color_background_bottom','#ffffff'));?>;

        color:<?php echo esc_attr(get_theme_mod('bottom_text','#000000'));?>;

        background-repeat:<?php echo esc_attr(get_theme_mod('bottom-repeat','repeat'));?>;

        background-position:<?php echo esc_attr(get_theme_mod('bottom-position','center center'));?>;

        background-size:<?php echo esc_attr(get_theme_mod('bottom-size','auto'));?>;

        align-items:<?php echo esc_attr(get_theme_mod('align_items_bottom','center'));?>;
        }

        .bottom a{color:<?php echo esc_attr(get_theme_mod('bottom_link','#d95370'));?>;}


        footer{justify-content:<?php echo esc_attr(get_theme_mod('justify_content_footer','space-around'));?>;
        
        background-image:url(<?php echo esc_attr(get_theme_mod('footer_site','none'));?>);

        background-color:<?php echo esc_attr(get_theme_mod('color_background_footer','#ffffff'));?>;

        color:<?php echo esc_attr(get_theme_mod('footer_text','#000000'));?>;

        background-repeat:<?php echo esc_attr(get_theme_mod('footer-repeat','repeat'));?>;

        background-position:<?php echo esc_attr(get_theme_mod('footer-position','center center'));?>;

        background-size:<?php echo esc_attr(get_theme_mod('footer-size','auto'));?>;

        align-items:<?php echo esc_attr(get_theme_mod('align_items_footer','center'));?>;
        }

        footer a{color:<?php echo esc_attr(get_theme_mod('footer_link','#d95370'));?>;}


        .logo{background-image:url(<?php echo esc_attr(get_theme_mod('logo_site','none'));?>);
            background-repeat:no-repeat;
            background-position:center center;
            height:<?php if(get_theme_mod('logo_site')!==''){echo '100px';}
            else{echo 'auto';}
            ?>;
            
            min-width:<?php if(get_theme_mod('logo_site')!==''){echo '200px';}
            else{echo 'auto';}
            ?>;  
        }

    </style>
<?php
}
add_action('wp_head','theme_customize_css');
