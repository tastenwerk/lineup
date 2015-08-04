<?php



  function add_ess_feed(){
    
    $type = 'lineupentry';
    $args=array(
      'post_type' => $type,
    //   'meta_query'=> array(
    //     array(
    //       'key' => 'venue_kukuk'
    //     )
    //   ),
      // 'orderby'   => 'title',
      // 'order'     => 'ASC'
    );


    // print_r( $args );

    $my_query = null;
    $my_query = new WP_Query($args);

    while ($my_query->have_posts()) : 
      $my_query->the_post();
      /************************************************************************************************
       *
       *  This complete exemple create an event feed that describe:
       *
       *  - A 2 hours Madonna concert that happend every years for three years at 9:30PM the 25th of Oct.
       *  - It happends in a stadium in New York.
       *  - This happening is defined with a category "concert" explained as "Rock music"
       *  - Several specific TAGs are attached to improve SEO.
       *  - The price is defined to $90 (with a URL for payment).
       *  - The event can be free with a specific card accreditation.
       *  - An image and a video is defined to give a face to the event.
       *
       ************************************************************************************************/

      include(dirname( __FILE__)."/lib/ess/FeedWriter.php");

      global $wp;
        $current_url = home_url(add_query_arg(array(),$wp->request));
      // print_r( $post );


      $feed_url   = str_replace('localhost', '127.0.0.1', $current_url).'.ess';
      $event_page = str_replace('localhost', '127.0.0.1', $current_url).'.html';

      // == Create the ESS Feed ================
      $essFeed = new FeedWriter( 'en', array(
          'title'     => $post->post_title,
          'link'      => $feed_url,
          'published' => $post->date,
          'rights'    => 'Mezzanintheater'
      ));

      $dates = get_post_meta($post->ID, 'lineupentry_dates', TRUE );


      // == Create an Event =====================
      $newEvent = $essFeed->newEventFeed( array(
          'title'         => $post->post_title,
          'uri'           => $event_page,
          'published'     => 'now',
          'access'        => 'PUBLIC',
          'description'   => $post->post_content,
          'tags'          => array( 'music', 'pop', '80s', 'Madonna', 'concert' )
      ));
      // -- Define event's category(s) --------------------------------
      $newEvent->addCategory( 'concert', array(
          'name' => 'Rock Music'
      ));

      foreach ($dates as $event ) {

          // -- Define event's date(s) ------------------------------------
          $newEvent->addDate('recurrent', 'year', 3, null,null,null,array(
              'name'      => 'Aufführung',
              'start'     => 'strtotime( $event[1] )',
              'duration'  => get_post_meta( $post->ID, 'lineupentry_duration', TRUE )
          ));

      }

          // -- Define event's place(s) -----------------------------------
          $newEvent->addPlace( 'fixed', null,array(
              'name'          => 'Stadium',
              'latitude'      => '40.71675',
              'longitude'     => '-74.00674',
              'address'       => 'Ave of Americas, 871',
              'city'          => 'New York',
              'zip'           => '10001',
              'state'         => 'New York',
              'state_code'    => 'NY',
              'country'       => 'United States of America',
              'country_code'  => 'US'
          ));

      // -- Define event's media files (images, sounds, videos, websites) -------------------
      $newEvent->addMedia('image',array('name'=>'Photo 01','uri'=>'http://madonna.com/i.png'));
      $newEvent->addMedia('video',array('name'=>'Video 02','uri'=>'http://madonna.com/v.ogg'));

      // == Add the event to the Feed
      $essFeed->addItem( $newEvent );

      // == Display the ESS Feed generated.
      $essFeed->genarateFeed();

    endwhile;

  }

?>