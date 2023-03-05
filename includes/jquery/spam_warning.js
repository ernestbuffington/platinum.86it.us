		function spamwarn_question()
		{
			if (confirm("You will not be protected from spam."))
			{
				document.getElementsByName("user_viewemail")[0].checked = true;
				return true;
			}
			else
			{
				document.getElementsByName("user_viewemail")[1].checked = true;
				return false;
			}
		}
