# Face Recognition Based Attendance Taking System

This is a senior year graduation project developed by:

Alper Buğra Çalışır<br />
Sinan Ulusoy<br />
Mustafa Cihan Gürbüz

## Installation
In order to use our system some modifications and preparations needs to be made. The first
one is one the server side.

One needs a Xammp web server solution stack package developed by Apache Friends. It
includes an Apache HTML Server and MariaDB which we will need in our server
deployment. It can be downloaded using the link:
https://www.apachefriends.org/index.html <br>
First, one needs to configure Apache so that other users in the local network can reach the
server. Domain can be used to have a better reachability to our system. In basic deployment,
a Static IP needs to be assigned so that users across the network can reach the system with
using this statically assigned IP. This can be done in Windows easily.

![Xampp Control Panel](https://github.com/calisir/face_recognition_based_attendance_taking_system/blob/master/readmeImages/1.png)

After opening Xampp Control Panel as Administrator, one can click “Config” and choose
“Apache(httpd.conf)” as shown below.

![Xampp Configuration](https://github.com/calisir/face_recognition_based_attendance_taking_system/blob/master/readmeImages/2.png)

After opening the file with a Notepad or similar application, “#Listen 12.34.56.78:80” should
be found and the next line should be changed accordingly. <br>
“Listen 8080” <br><br>
Now 8080 can be used. <br><br>
Next, ServerName needs to be changed. After locating ServerName in the same file, it has to
be change like this: <br>
ServerName IPadress:8080<br>
Now, we can safely save and close the file.<br>
Afterward we move to allocate a port for our MySQL database. In the same Control Panel we
opened the Apache configuration file we go and click the corresponding Config for MySQL.<br>
Then, in the file we look for:<br>
```bash
# The MySQL server
[mysqld]
```
In this part, we change the port to 3307 from 3306 from preassigned value of localhost. After
configuring this, our file needs to look like this:<br>

![alt text](https://github.com/calisir/face_recognition_based_attendance_taking_system/blob/master/readmeImages/3.png)


After this step, we are done!<br>
We can safely reach both our server and database.<br>
In order to run the fact recognition modules, we need to run these commands:<br>


```python
curl https://bootstrap.pypa.io/get-pip.py -o get-pip.py
python get-pip.py
pip install Keras
pip install -U scikit-learn
pip install opencv-python
pip install matplotlib
pip install progressbar
pip install joblib
```


## Usage

We used GitHub for versioning and deploying the system. The actual deployment of the
system is on a reserved computer acting as a server host for the web user interface, accessible
through LAN. The dataset training, facial recognition and attendance taking are also deployed
on the dedicated computer.

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
