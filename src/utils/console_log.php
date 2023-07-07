<?php
function console_log($output, $with_script_tag = true)
{
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
  if ($with_script_tag) {
    $js_code = '<script>
  ' . $js_code . '
</script>';
  }
  echo $js_code;
}
