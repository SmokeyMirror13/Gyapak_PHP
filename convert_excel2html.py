import pandas as pd 
import xlwings as xw
import sys
import os
import xml.etree.ElementTree as et

fname = os.path.abspath(sys.argv[1])
if fname[-3:] == "csv" :
    wb = pd.read_csv(os.path.abspath(sys.argv[1]))
elif fname[-4:] == 'xlsb':
    app = xw.App()
    book = xw.Book(fname)
    wb = book.sheets.active.range('A1').options(pd.DataFrame, expand='table').value
else:
    wb = pd.read_excel(os.path.abspath(sys.argv[1]))
ht = pd.DataFrame.to_html(wb)
print(ht)