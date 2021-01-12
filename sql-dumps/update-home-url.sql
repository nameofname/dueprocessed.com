update wp_options
    set option_value = 'http://localhost:8000'
    where option_name in ('home', 'siteurl')
;
