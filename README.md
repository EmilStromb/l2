Username: Admin
Password: Password

error message 'post bytes exceeds the limit of 41943040 bytes'
solution: 
I searched to find and fix a problem with to large files, could only find this one 
https://www.gomahamaya.com/warning-post-content-length-exceeds-limit/
But since this is only for me currently you need to do the same thing. 
This would be avoided if not using an open source sqlDatabase and would then not present a error message like this.

added user cases:

UC1 upload file

Preconditions
A user is logged in.

Main scenario
1. 'choose file' is pressed
2. a file is chosen
3. upload is pressed
4. system presents 'Video uploaded successfully'

Alternate Scenarios
4. a: video was to large and says 'Something went wrong, was the file to large?'

UC2 all videos

Preconditions
A user is logged in.

Main scenario
1. 'videos' is pressed
2. system presents all available vidoes

UC3 watch video

Preconditions
A user is logged in.

Main scenario
1. 'videos' is pressed
2. system presents all available vidoes
3. user chooses an available video
4. system presents the chosen video
