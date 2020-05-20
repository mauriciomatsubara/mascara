UPDATE wp_options SET option_value = replace(option_value, 'https://www.masklife.com.br', 'https://mascara.teste.pro.br') WHERE option_name = 'theme_mods_flatsome-child' OR 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'https://www.masklife.com.br', 'https://mascara.teste.pro.br');
UPDATE wp_posts SET post_content = replace(post_content, 'https://www.masklife.com.br', 'https://mascara.teste.pro.br');

