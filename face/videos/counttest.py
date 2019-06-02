


import os
import argparse
from collections import Counter

f = open("C:/xampp/htdocs/face/snapshots/2019-05-24/492/13-40-00/attendance.txt","r")
text = f.read()

c = Counter()
for line in text.splitlines():
    c.update(line.split())
print(c)

present = []

for student in c:
    if (c[student]>=6):
        present.append(student)

print(present)