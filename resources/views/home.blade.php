<h2>Hi</h2>
<h3>Your Info :
    {{ Auth::user() }}</h3>
<h2>
    Your lesson :
    {{ Auth::user()->students_leson }}</h2>
<h2>
    Your attendance info :
    {{ Auth::user()->my_attandance }}</h2>
<h2>
    Are you instructor? :
    {{ Auth::user()->instructor}}
</h2>
<h2>
	Lesson you have opened : 
	{{  Auth::user()->instructor->teachers_lessons }}
</h2>
 