/**
Run this snippet in the JS console on the "Assign Authors"
step when running a WordPress import to automatically select
the author from the drop down that matches corresponding
author name shown from the incoming import data.
*/
$=jQuery;
$('#authors > li').each(function () {
  $(this).find(`select option:contains('${$(this).find('> strong').text().replace(/^(.*) \(.+\)$/, '$1')}')`)
    .prop('selected', true);
});
