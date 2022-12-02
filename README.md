# opencv-auto-picture-process-webcam
This app takes pictures from the local webcam and then processing the images through OpenCV


This is a PHP Web App that allows you to take pictures from the local webcam, process the pictures through OpenCV with a preselected filter, and then the images are displayed with bounding boxes around the objects detected.

Prerequisites:
  -Install OpenCV for Python
  -Make www-data a member of the video group - usermod -a -G video USERNAME
    This gives access to the local webcam to the user account that runs the script
    We use shell_exec() in PHP to trigger the python script
  -Create pics folder and giev appropriate permissions
  -Copy OpenCV data folder into web app root directory


YouTube Demo: https://youtu.be/UnI9Mf1UhJ4
