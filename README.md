# Rock :fist: Paper :raised_hand_with_fingers_splayed: Scissors :v: Game:

<a href = "http://rockps.42web.io/">Check it out!</a>

A simple Rock Paper Scissors game with a login page created with HTML, CSS & PHP.

The user plays against the computer. The move of the computer is generated using built in rand() fucntion of PHP.

The user needs to first set a password. That password is stored in a pass.txt file and is encrypted using md5() built in has function of PHP. The default password is 'f'. I have used the md5 fucntion and not the password_hash fucntion to understand the algorithm and practice various decrypting techniques.

The basic Model View Control (MVC) pattern is used so that the code is more organised and easy to read.
