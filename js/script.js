script =
{	
	init:function()
	{
		var _this = script;


		$("#search div").on("click", function()
		{
			$("#search input").toggle("slide", {direction: 'right'}, 40);
		});


		$(".vote").on("click", "a", _this.clickVote);
	},


	clickVote:function()
	{/*
		var _this = script;
		var parent = $(this).parent();
		
		var link = $(this).attr("href");
		console.log(link)
		
		$.ajax
		({
			url: link,
			success: function(html)
			{
				console.log($(html).find("#test p").text());
				//parent.find("p").replaceWith(mytext);

			}
		});

		return false;*/
	}
	
}


$(script.init());