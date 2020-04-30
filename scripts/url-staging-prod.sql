UPDATE wp_options SET option_value = replace(option_value, 'https://mascara.teste.pro.br', 'https://www.masklife.com.br') WHERE option_name = 'theme_mods_flatsome-child' OR 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'https://mascara.teste.pro.br', 'https://www.masklife.com.br');
UPDATE wp_posts SET post_content = replace(post_content, 'https://mascara.teste.pro.br', 'https://www.masklife.com.br');

