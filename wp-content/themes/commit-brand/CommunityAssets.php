<?php
    /**
     * Template Name: CommunityAssets
     */
get_header();
?>

<div id="primary" class="one-col-content">
	<?php get_template_part('content-grey', 'page' ) ; ?>
</div>

<?php
get_footer(); ?>


<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $(".CommunityAssets").each(function (i) {
                var filter = $("#CommunityDestination").attr("data-filter");
                $("tr").each(function (index) {
                    that = $(this);
                    //alert(index + ':' + $(this).html());
                    //destination.append('<a href=\'' + $(this).find("td.column-3").html() + '\'> Test Link</a><br>');
                    tags = that.find("td.column-6").html();
                    if (tags && tags.indexOf(filter) >= 0 || filter == 'All') {
                        addRow(that, tags, false);
                    }

                })
            })
            $(".CommunityAssets").remove();
			$(".col2").removeClass("col2");
        });


        function addRow(that, tags, hidden) {
            assetName = that.find("td.column-1").html();
            description = that.find("td.column-2").html();
            websiteLink = that.find("td.column-3").html();
            volunteerLink = that.find("td.column-4").html();
            imageSource = that.find("td.column-5").html();
            destHtml = hidden ? '<tr data-filter="' + tags + '" class="hidden-element">' : '<tr  data-filter="' + tags + '" >';
            destHtml += '<td class="asset-img"><img src="' + imageSource + '" alt="' + assetName + '" />';
            destHtml += '</td>';
            destHtml += '<td class="asset">';
            destHtml += '<a href="' + websiteLink + '">';
            destHtml += '<span class="asset-link">' + assetName + '</span>';
            destHtml += '</a>';
            if (volunteerLink) {
                destHtml += '<a class="volunteer-link" href="' + volunteerLink + '" target="_blank">Volunteer Now!</a>';
            }
            destHtml += '<br/>' + description;
            destHtml += '</td>';
            destHtml += '</tr>';
            $("#CommunityDestination").append(destHtml);
        }

        function filterList(filter) {
            $("tr").each(function (index) {
                that = $(this);
                var tags = that.attr("data-filter");
                if (tags && tags.indexOf(filter) >= 0 || filter == 'All') {
                    that.removeClass('hidden-element');
                }
                else {
                    that.addClass('hidden-element');
                }
            })
        }


        // Hide all assets that don't start with A
        $("#a").click(function () {
            $("tr").each(function (index) {
                var name = this.find("td.asset");
            })
        });

        $(".filter-button").click(function () {
            // Filter
            var filter = $(this).attr("data-filter");
            filterList(filter)

            // Scroll Down
            $('html, body').animate({
                scrollTop: $(".list").offset().top - 45
            }, 1600);
        })

        $(".back-top").click(function () {
            // Scroll up
            $('html, body').animate({
                scrollTop: $(".top").offset().top - 125
            }, 1600);
        })

    })(jQuery);
</script>
