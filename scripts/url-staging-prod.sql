UPDATE wp_options SET option_value = replace(option_value, 'https://keisui.teste.pro.br', 'https://www.keisui.com.br') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET guid = replace(guid, 'https://keisui.teste.pro.br', 'https://www.keisui.com.br');
UPDATE wp_posts SET post_content = replace(post_content, 'https://keisui.teste.pro.br', 'https://www.keisui.com.br');

