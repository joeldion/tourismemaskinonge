<?php

add_filter('body_class', 'tm_template_body_class');
/**
 * If the current page has a template, apply it's name to the list of classes. This is
 * necessary if there are multiple pages with the same template and you want to apply the
 * name of the template to the class of the body.
 *
 * @param array $classes The current array of attributes to be applied to the 
 */
function tm_template_body_class($classes)
{
  if (!empty(get_post_meta(get_the_ID(), '_wp_page_template', true))) {
      // Remove the `template-` prefix and get the name of the template without the file extension.
      $templateName = basename(get_page_template_slug(get_the_ID()));
      $templateName = str_ireplace('template-', '', basename(get_page_template_slug(get_the_ID()), '.php'));

      $classes[] = $templateName;
  }
  
  return array_filter($classes);
}