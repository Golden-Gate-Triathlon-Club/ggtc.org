<?php
if( have_rows('components') ):
    while( have_rows('components') ): the_row();
        if( get_row_layout() == 'slider' ):
            get_template_part('components/slider'); 
        elseif( get_row_layout() == 'cta-banner' ):
            get_template_part('components/section-cta-banner');
        elseif( get_row_layout() == 'text-section-1-column' ):
            get_template_part('components/section-text-1-column');
        elseif( get_row_layout() == 'text-section-2-column' ):
            get_template_part('components/section-text-2-column');
        elseif( get_row_layout() == 'photo-banner-full-width' ):
            get_template_part('components/section-photo-banner-full-width');
        endif;
    endwhile;
endif;
?>