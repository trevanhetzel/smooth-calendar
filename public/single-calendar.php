<?php
$single = get_option('calendar_setting_single');

if ($single) {
  if ( $overridden_template = locate_template( 'single-calendar.php' ) ) {
     // locate_template() returns path to file
     // if either the child theme or the parent theme have overridden the template
     load_template( $overridden_template );
   } else {

    get_header();

    while ( have_posts() ) : the_post();

    the_title( '<h1 class="entry-title">', '</h1>' );

    $date = get_post_meta( $post->ID, 'meta_calendar_date', true );
    $startTime = get_post_meta( $post->ID, 'meta_calendar_start', true );
    $endTime = get_post_meta( $post->ID, 'meta_calendar_end', true );
    $location = get_post_meta( $post->ID, 'meta_calendar_location', true );
    $description = get_post_meta( $post->ID, 'meta_calendar_description', true );
    $show_gcal = get_option('calendar_setting_gcal');

    if ($date) {
      echo '<p><strong>Date:</strong> ' . $date . '</p>';
    }

    if ($startTime) {
      echo '<p><strong>Time:</strong> ' . $startTime;

      if ($endTime) {
        echo ' - ' . $endTime . '</p>';
      } else {
        echo '</p>';
      }
    }

    if ($location) {
      echo '<p><strong>Location:</strong> ' . $location . '</p>';
    }

    if ($description) {
      echo $description;
    }

    if ($show_gcal && $date && $startTime) {
      echo '<p><a class="smooth-cal__save" target="_blank" class="btn" href="https://www.google.com/calendar/render?action=TEMPLATE';
      echo '&text=' . get_the_title();

      if ($endTime) {
        echo '&dates=' . date('Ymd\\THi00', strtotime($date . ' ' . $startTime)) . '/' . date('Ymd\\THi00', strtotime($date . ' ' . $endTime));
      } else {
        echo '&dates=' . date('Ymd\\THi00', strtotime($date . ' ' . $startTime)) . '/' . date('Ymd\\THi00', strtotime($date . ' ' . $startTime));
      }

      if ($location) {
        echo '&location=' . $location;
      }

      echo '&sf=tru&output=xml">Save to Google Calendar</a></p>';
    }

    endwhile;

    get_footer();

  }
} else {
  wp_redirect( home_url() );
  exit;
}

?>
