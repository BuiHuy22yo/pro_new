<?php
function aht_social_share(){ ?>
    <div class="share-post-wp box-share">
        <a class="icon-share icon-sh-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"  target="_blank" rel="nofollow">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="icon-share icon-sh-tw" href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank" rel="nofollow">
            <i class="fab fa-twitter"></i>
        </a>
        <a class="icon-share icon-sh-linkin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title() ?>&summary=&source=" target="_blank" rel="nofollow">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a class="icon-share icon-sh-pinter" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=sad&description=<?php the_title() ?>" target="_blank" rel="nofollow">
            <i class="fab fa-pinterest-p"></i>
        </a>
    </div>
<?php }