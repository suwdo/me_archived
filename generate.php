<?php

// Load up static content
$header = file_get_contents('header.html');
$footer = file_get_contents('footer.html');
$disclaimer = file_get_contents('disclaimer.html');

/**
 * Generate a page with given header, footer, and contents
 *
 * @param string $header
 * @param string $footer
 * @param string $contents
 *
 * @return string
 */
function generatePage(string $header, string $footer, string $contents)
{
  return $header . $contents . $footer;
}

// Generate index page
file_put_contents('docs/index.html', generatePage($header, $footer, ''));

// Generate climbing index pages
file_put_contents(
  'docs/climbing.html',
  generatePage(
    $header,
    $footer,
    $disclaimer . file_get_contents('climbing.html')
  )
);

// Generate climbing pages
$climbingFiles = scandir('climbing/');

foreach ($climbingFiles as $climbingFile) {
  if (strpos($climbingFile, '.html') === false) {
    continue;
  }
  $fileContents = $disclaimer . file_get_contents("climbing/$climbingFile");
  file_put_contents("docs/$climbingFile", generatePage($header, $footer, $fileContents));
}

?>
