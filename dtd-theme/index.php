<?php
  if (function_exists('get_header')) {
    get_header();
  } else {
    // Whatever you want to do when the file is accessed directly would go here. Maybe redirect them to your home page?
  }
?>
<!-- css -->
<link rel="stylesheet"  href="<?php bloginfo( 'template_directory' ); ?>/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo( 'template_directory' ); ?>/dist/css/lightbox.css">
<link  rel="stylesheet"  href="<?php bloginfo( 'template_directory' ); ?>/dist/css/yodex_style.css">
<!-- font-family -->

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <div class="text-center row">
        <div class="title col-md-12">
          <p>YODEX 新一代設計展</p>
          <div class="full-line"></div>
        </div><!-- title -->
        <div class="main-nav col-md-12">
          <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="active" id="myTabs"><a href="#107Screen" role="tab" data-toggle="tab">107級</a></li>
            <li role="presentation" id="myTabs"><a href="#108Screen" role="tab" data-toggle="tab">108級</a></li>
          </ul>
        </div><!-- main-nav -->

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="107Screen">
              <div class="section-01 col-md-10 col-md-offset-1">
                <div id="carousel-sec-01" class="carousel slide" data-ride="carousel">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <ul class="sec-01-images">
                        <li class="sec-01-img-left"><img src="dist/images/img/sec-01-img.png"/></li>
                        <li class="sec-01-img-right sm-hide"><img src="dist/images/img/sec-01-img.png"></li>
                      </ul>
                    </div>
                    <div class="item">
                      <ul class="sec-01-images">
                        <li class="sec-01-img-left"><img src="dist/images/img/sec-01-img.png"/></li>
                        <li class="sec-01-img-right sm-hide"><img src="dist/images/img/sec-01-img.png"></li>
                      </ul>
                    </div>
                    <div class="item">
                      <ul class="sec-01-images">
                        <li class="sec-01-img-left"><img src="dist/images/img/sec-01-img.png"/></li>
                        <li class="sec-01-img-right sm-hide"><img src="dist/images/img/sec-01-img.png"></li>
                      </ul>
                    </div>
                  </div>
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-sec-01" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-sec-01" data-slide-to="1"></li>
                    <li data-target="#carousel-sec-01" data-slide-to="2"></li>
                  </ol>
                </div>
              </div><!-- section-01 -->

              <div class="section-03">
                <div class="title col-md-10 col-md-offset-1  text-center">
                  <p>作品展示</p>
                  <div class="full-line"></div>
                </div><!-- title -->
                <div class="sec-03-content col-md-10 col-md-offset-1 text-center">
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in sec-03-images active" id="topic1">
                      <div id="carousel-sec-03-topic1" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox" style="padding:0 0 10% 0">
                          <?php $sliderCounter=0; $marryCounter=0; ?>
                          <?php $args = array(
                                        'post_type'     => 'work',
                                        'posts_per_page'=> -1,   // set the limit post to UNLIMITED (-1 is unlimited)
                                        'orderby'       => 'rand',);
                                $query = new WP_Query( $args );
                                $query_contents=Array();
                          while ( $query->have_posts() ) : $query->the_post(); ?>
                                 <?php switch($sliderCounter){
                                  case 0:
                                  echo '<div class="item active"><ul>';
                                  case 4:
                                  echo '<li class= "sec-03-img-1">';
                                  break;
                                  case 1:
                                  case 5:
                                  echo '<li class= "sec-03-img-2">';
                                  break;
                                  case 2:
                                  case 6:
                                  echo '<li class= "sec-03-img-3">';
                                  break;
                                  case 3:
                                  case 7:
                                  echo '<li class= "sec-03-img-4">';
                                  break;
                                  case 8:
                                  echo '<div class="item"><ul>' . '<li class= "sec-03-img-1">';
                                  $sliderCounter=0;
                                  $marryCounter++;
                                  break;
                                  default:
                                  break; }?>

                                 <a href=" <?php echo the_permalink(); ?>">
                                  <?php the_post_thumbnail('full');  $sliderCounter++; ?>
                                 </a></li>
                                 <?php switch($sliderCounter){    
                                  case 4:  
                                  echo "</ul><ul>";
                                  break;
                                  case 8:
                                  echo '</ul></div>';
                                  break;
                                  default: 
                                  break;}?>
                                <?php  endwhile;   ?>
                                
                          </ul></div>
                                             
                        </div>
                        <ol class="carousel-indicators">
                        <?php  $dataSlider=0;
                                if ($marryCounter):
                                while ($marryCounter>=0) :  ?>
                          <li data-target="#carousel-sec-03-topic1" data-slide-to="<?php  echo $dataSlider; ?>"
                           <?php if($dataSlider==0):echo 'class="active"';  endif;?> ></li>
                        <?php  $dataSlider++; $marryCounter--; endwhile;   endif; ?>
                        </ol>
                      </div><!-- carousel-sec-03-topic1 -->
                    </div><!-- topic1 -->
                  </div><!-- tab-content -->
                </div><!-- sec-03-content -->
              </div><!-- section-03 -->
            </div><!-- drawerScreen -->
            <div role="tabpanel" class="tab-pane fade" id="108Screen">
              
            </div><!-- beginitScreen -->
            
          </div><!-- tab-content -->
      </div>   
<!-- jquery / js -->
<script src="<?php bloginfo( 'template_directory' ); ?>/dist/js/yodex_script.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/dist/js/jquery.min.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/dist/js/bootstrap.min.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/dist/js/bootstrap.js"></script>
<script src="<?php bloginfo( 'template_directory' ); ?>/dist/js/lightbox.js"></script>


<?php get_footer(); ?>