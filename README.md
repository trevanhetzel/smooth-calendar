Smooth Calendar
==========

### A simple and flexible WordPress calendar plugin

Smooth Calendar is a straightfowrward solution to displaying events on a WordPress site. First and foremost, the calendar view allows users of your site to quickly see events for a given month. Multiple events can be displayed on a single day and there is an option to display a single page for each event, perfect for linking people to an event page from social media!

The plugin uses JavaScript to fetch data, which provides for a fast and easy to use experience for users. The experience in the Dashboard is also very user friendly, as each event is a custom post type with easy to understand fields.

While the plugin can certainly be installed and used right out of the box, there is much room for flexibility and extending the plugin. From styling it to fit your site's theme to adding even more functionality, this plugin was written in an extendable way to fit you as a site owner's or developer's needs.

A lot of time has been spent to make this calendar plugin as user friendly on as many devices as possible. It's fully responsive and works on every modern device it's viewed on. Phone, tablet, laptop or desktop, the user experience is just the same!

There is an abundance of WordPress calendar plugins, but if you're looking for a responsive, easy to get going (and easy for clients to manage) calendar plugin, Smooth calendar is your best bet!

### Features

- Responsive
- Supports multiple events on a single day
- "Quick view" of event
- Ability to have single pages for each event (which makes it SEO friendly)
- Customizable colors
- Easily extendable
- Uses custom post types and metadata, which makes creating your own theme very straightforward
- Allows the display of an event title, date, start/end time, location and description
- Google Calendar integration

### Installation

1. Upload [`smooth-calendar`](https://github.com/trevanhetzel/smooth-calendar/archive/master.zip) to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the calendar in a page using the shortcode `[smooth-calendar`] (optionally place it in a theme file with `<?php echo do_shortcode('[smooth-calendar]'); ?>`)
4. Update the settings by viewing the Settings page under the 'Calendar' tab. If you'd like each event to have its own page, check the 'Enable single pages' checkbox.

### FAQ

**How can I modify the "single" template**

The single event template can be overridden by adding a file in your theme called `single-calendar.php`.

**Can I have multiple calendars?**

No. Currently, only one calendar is supported. You could technically display multiple calendars by using categories or tags though.

**How can I display upcoming events elsewhere on my site?**

You can write a loop, querying the `calendar` post type and ordered by the `meta_calendar_data` meta value. Something like this:

```
<?php
$events_args = array(
    'post_type' => array('calendar'),
    'showposts' => 3,
    'meta_key' => 'meta_calendar_date',
    'meta_value' => date('Y-m-d'),
    'meta_compare' => '>=',
    'orderby' => 'meta_value',
    'order' => 'ASC'
);

$events_posts = get_posts($events_args);

echo '<ul class="upcoming">';

foreach ($events_posts as $post) {
    setup_postdata( $post ); ?>

    <li class="upcoming__event">
        <div class="upcoming__date">
            <?php echo date("j", strtotime($post->meta_calendar_date)); ?>
            <span class="upcoming__month"><?php echo date("M", strtotime(($post->meta_calendar_date))); ?></span>
        </div>

        <a href="<?php the_permalink(); ?>" class="upcoming__title"><?php the_title(); ?></a>
        <p class="upcoming__desc"><?php echo $post->meta_calendar_location; ?></p>
    </li>
<?php } ?>
```

### Screenshots

![Desktop view](/assets/screenshot-1.png?raw=true "Desktop view")

![Desktop hover view](/assets/screenshot-2.png?raw=true "Desktop hover view")

![Tablet view](/assets/screenshot-3.png?raw=true "Tablet view")

![Mobile view](/assets/screenshot-4.png?raw=true "Mobile view")

![Mobile hover view](/assets/screenshot-5.png?raw=true "Mobile hover view")

![Single page view](/assets/screenshot-6.png?raw=true "Single page view")

![Dashboard view](/assets/screenshot-7.png?raw=true "Dashboard view")

![Dashboard edit view](/assets/screenshot-8.png?raw=true "Dashboard edit view")
