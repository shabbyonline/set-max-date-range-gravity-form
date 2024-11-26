
<!-- Set Maximum Limit of Date DropDown Feild -->
<?php
    add_filter('gform_date_max_year', function ($max_date, $form, $field) {
    // Check if the form ID is 7 and the field ID is 5
    if ($form['id'] == 13 && $field->id == 7) {
        // Get the current year
        $current_year = date('Y');

        // Calculate the max date as current year minus 1
        $max_date = $current_year - 1;

        // Return the updated max date
        return $max_date;
    }

    // Return the original max date for other fields  
    return $max_date;
}, 10, 3);


//Created CPT when the form is submmited 
// Hook to execute after the form is submitted
add_action('gform_after_submission_6', 'create_custom_post_after_submission', 10, 2);

function create_custom_post_after_submission($entry, $form)
{
    // Check if the form ID matches the form you want to target
    if ($form['id'] == 7) {

        // Get form data
        $field_value_1 = rgar($entry, '7'); // Replace '1' with the actual field ID
        $field_value_2 = rgar($entry, '6'); // Replace '2' with the actual field ID

        // Create post data
        $post_data = array(
            'post_title' => $field_value_1,
            'post_content' => $field_value_2,
            'post_type' => 'post_type_658c3f175aaf6', // Replace with your custom post type
            'post_status' => 'publish',
        );

        // Insert the post into the database
        $post_id = wp_insert_post($post_data);

        // You can add more logic here if needed

        // Optionally, redirect to a specific page after form submission
        wp_redirect('https://your-redirect-url.com');
        exit();
    }
}
?>


