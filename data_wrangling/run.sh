#!/bin/bash


# Download from API into globaldict.jsonb
python download.py

# Create CSV basicdata.tsv by manipulating globaldict.json and nutsrelations.psv
python createcsv.py

# Generate similarities
# Set to either do all or one
python similarity.py

# Import data into nuts.db (sqlite)
# in order to import data in SQLITE, replace ERROR, N/A, NONE with "" and remove header from basicdata.tsv
# create table nuts (code text PRIMARY KEY, level text, name text, nuts0 text, nuts1 text, nuts2 text, pop3 real, pop2 real, pop1 real, pop0 real, density real, fertility real, popchange real, womenratio real, gdppps real, gva real);
# .separator "|"
# .import basicdata.tsv nuts



# 5. import also all nuts relations (as basicdata only contains NUTS3!)
#"DE113|Esslingen|3|DE|DE1|DE11|DE113"
#create table relations(code text PRIMARY KEY, name text, level text, nuts0 text, nuts1 text, nuts2 text, nuts3 text);
#.separator "|"
#.import nutsrelations.psv relations

# Move files to web
# TODO
