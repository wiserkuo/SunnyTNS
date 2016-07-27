# wiserkuo
A SunnyTNNS system for student and coach

# Update logs
20160727

*login.php: 

upperform = student login (by facebook or pre-setup accounts in SQL) 

lowerform=coach login

*sunny_student.php:  

1.It uses facebook api to create/login by fb account's internal access_token. In order to implement auto-login , access_token is saved as account's password in SQL table student_list.

2.It shows registered class's info,class materials,class attending records,message for each attends. 

*sunny_coach.php: 

1.It shows coach's  info of there own classes , class materials , student list , student attending records.

2.Student list has selection list to modify student's level , it calls function changeLevel and uses AJAX technique,on background,call change_level.php to change value of Level field in SQL table student_list. 
<!-- 
# Platforms
Amen is developed on Ubuntu 14.04 and higher.  OS X should be workable.  Windows users should install Ubuntu.

# Installation
Amen is pretty simple, but it stands on top of some complex stuff.

If you are on Linux, you'll need `libsoundfile`:  `sudo apt-get install libsndfile1`.  If you're on OS X, read on.

Next, you should install Anaconda, (https://www.continuum.io/downloads) which will get you all of the dependencies.

Then, install via pip:  `pip install amen`.  That should be it!

(If you're a serious Python cat, you can just get Amen from pip, without Anaconda - but that will require installing numpy, scipy, a fortran compiler, and so on.)

# Testing the Installation
After installation is finished, open up a Python interpreter and run the following (or run it from a file):
```
from amen.utils import example_audio_file
from amen.audio import Audio
from amen.synthesize import synthesize

audio_file = example_audio_file()
audio = Audio(audio_file)

beats = audio.timings['beats']
beats.reverse()

out = synthesize(beats)
out.output('reversed.wav')
```

If all that works, you just need to play the resulting `reversed.wav` file, and you're on your way!

# Examples

We've got a few other examples in the `examples` folder - most involve editing a file based on the audio features thereof.  We'll try to add more as we go.

# Contributing
Welcome aboard!  Please see CONTRIBUTING.md, or open an issue if things don't work right.

# Thanks
Amen owes a very large debt to Echo Nest Remix.  Contributors to that most esteemed library include:
* Chris Angelico
* Yannick Antoine
* Adam Baratz
* Ryan Berdeen
* Dave DesRoches
* Dan Foreman-Mackey
* Tristan Jehan
* Joshua Lifton
* Adam Lindsay
* Aaron Mandel
* Nicola Montecchio
* Rob Oschorn
* Jason Sundram
* Brian Whitman
 -->