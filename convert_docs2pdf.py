import sys
import os
import comtypes.client
import base64

input_file_path = sys.argv[1]
output_file_path = sys.argv[2]
# print(str(base64.b64decode(input_file_path)))
input_file_path = os.path.abspath(str(base64.b64decode(input_file_path))[2:-1])
output_file_path = os.path.abspath(str(base64.b64decode(output_file_path))[2:-1])
print(input_file_path)
print(output_file_path)
word = comtypes.client.CreateObject("Word.Application")

if output_file_path[-3:] != 'pdf':
    output_file_path = output_file_path + ".pdf"
doc = word.Documents.Open(input_file_path)
doc.SaveAs(output_file_path, FileFormat=17)
doc.Close()
word.Quit()