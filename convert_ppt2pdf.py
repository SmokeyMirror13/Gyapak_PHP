import sys
import os
import comtypes.client
import base64


input_file_path = sys.argv[1]
output_file_path = sys.argv[2]
input_file_path = os.path.abspath(str(base64.b64decode(input_file_path))[2:-1])
print(input_file_path)
output_file_path = os.path.abspath(str(base64.b64decode(output_file_path))[2:-1])
powerpoint = comtypes.client.CreateObject("Powerpoint.Application")
powerpoint.Visible = 1

if output_file_path[-3:] != 'pdf':
    output_file_path = output_file_path + ".pdf"
deck = powerpoint.Presentations.Open(input_file_path)
deck.SaveAs(output_file_path, 32) # formatType = 32 for ppt to pdf
deck.Close()
powerpoint.Quit()