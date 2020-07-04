# Usage: compile.py language file_name. Output: output.json
import os
from sys import argv
# import re
# import json
import base64

# language = argv[1]
file_name = os.path.abspath(str(base64.b64decode(argv[1]))[2:-1])
# print(file_name)
# command = None
# if language == 'py':
#     command = 'python ' + file_name
# elif language == 'java':
#     java_regex = re.compile(r'(\S+).java')
#     mo = re.search(java_regex, file_name)
#     command = 'javac ' + file_name + ' && java ' + \
#         mo.group(1) + '&& del ' + mo.group(1) + '.class'
# elif language == 'cpp':
#     cpp_regex = re.compile(r'(\S+).cpp')
#     mo = re.search(cpp_regex, file_name)
#     command = 'g++ ' + file_name + ' -o ' + \
#         mo.group(1) + ' && ' + mo.group(1) + ' && del ' + mo.group(1)
# else:
#     exit(1)


# dict = {}
# print(command)
# output = os.popen(command).read()
# print(output)
with open(file_name, 'r') as f:
    output = f.read()
# dict['output'] = output
# output_json = json.dumps(dict)
print(output)
# with open('output.json', 'w') as f:
#     f.write(output_json)