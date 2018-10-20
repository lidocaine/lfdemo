(function($){

    $(document).ready(function(){

        $('.member-headshot').on('click',function(ev){
            let others = $(this).parents('.team-members-contain').find('.team-member header.member-headshot').not(this);

            if(!$(this).hasClass('open')) {
                openMemberBio(this);
                others.each(function(){
                    closeMemberBio(this);
                });
            } else {
                closeMemberBio(this)
            }

            function closeMemberBio(el) {
                $(el).removeClass('open');
                $(el).siblings('.member-data-contain').stop().removeClass('open').slideUp();
            }

            function openMemberBio(el) {
                $(el).addClass('open');
                $(el).siblings('.member-data-contain').stop().slideDown().addClass('open');
            }
        });

    });

})(jQuery);