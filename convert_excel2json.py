import xlrd 
import sys
import os
import json
import pandas as pd
# book = xlrd.open_workbook(os.path.abspath(sys.argv[1]))
# Book = {}
# for num in range(book.nsheets):
#     Book[str(num)] = {}
#     sheet = book.sheet_by_index(num)
#     for nr in range(sheet.nrows):
#         # Book[str(num)] = {}
#         rowheader = sheet.row_values(0)
#         if(nr == 0):
#             for hc in rowheader:
#                 Book[str(num)][str(hc)] = {}
#         else:
#             row = sheet.row_values(nr)
#             i = 0
#             for hc in rowheader:
#                 Book[str(num)][str(hc)][nr] = row[i]
#                 i = i + 1
# y = json.dumps(Book)
# print(y)
# with open('data.json', 'w') as f:
#     f.write(y)
fname = os.path.abspath(sys.argv[1])
if fname[-3:] == "csv" :
    j = pd.DataFrame.to_json(pd.read_csv(os.path.abspath(sys.argv[1])))
else:
    j = pd.DataFrame.to_json(pd.read_excel(os.path.abspath(sys.argv[1])))
print(j)