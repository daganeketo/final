#-*Makefile-*-
# Krishna Kafley CIS3238-Lab3

CFLAGS=-O3
OBJS =-L../../../mysql_connector/lib -lmysqlclient
INC =-I../../../mysql_connector/include

all:touch Lab11 Lab12
Lab11 : matrixmultiply.c
		cc $(CFLAGS) $(INC) -DN=$(SIZE) -o Lab11 matrixmultiply.c $(OBJS)
Lab12 : matrixmultiply12.c
		cc $(CFLAGS) $(INC) -DN=$(SIZE) -o Lab12 matrixmultiply12.c $(OBJS)
touch :
		touch *.c

	