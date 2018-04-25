#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <string.h>
#include "my_global.h"
#include "mysql.h"
#include <sys/time.h>
#include <sys/resource.h>

double wall_clock() {
	
	struct timeval tp;
	struct timezone tzp;
	double t;
	
	gettimeofday(&tp, &tzp);
	t=(tzp.tz_minuteswest*60 + tp.tv_sec)*1.0e6 + (tp.tv_usec)*1.0;
	
	return t;
	
}
	double A[N][N];
	double B[N][N];
	double C[N][N];
main(argc, argv)
	int argc;
	char **argv[];
	{
		char host[128];
		int i,j,k;
		double t0, t1, Mflops;
		
		MYSQL *con; //MYSQL connection
		MYSQL_RES *result; //MySQL result set
		MYSQL_ROW row;
		char *server = "cis-linux2.temple.edu";
		char *user = "tuf95300";
		char *password = "afezeegi";
		char *database = "SP18_3238_tuf95300";
		char query[1000];
		struct tm *newtime;
		time_t ltime;
		char *asctime(const struct tm *time);
		time(&ltime);
		newtime = localtime(&ltime);
		
		printf("The MYSQL client version is: %s\n", mysql_get_client_info());
		con =mysql_init(NULL); //get a connection
		if (!mysql_real_connect(con, server, user, password, database, 0, NULL, 0)){
			perror(mysql_error(con));
			exit(-1);
		}
		//truncate the table
		strcpy(query, "truncate table PLogs");
		if(mysql_query(con, query)){ //for this call to succeed it must return 0 which is true in unix convention. 
			perror(mysql_error(con)); //if it returns 1,2 and above i.e it failed and program exits.
			exit(-2);
		}
		
		//Get hostname
		gethostname(host, sizeof(host));
		
		//ijk
		
		for(i = 0; i<N; i++)
		{
			for(j= 0; j<N; j++)
			{
				C[i][j] = 0;
				A[i][j] = (double)(i*j);
				B[i][j] = (double) (i*j);
				
			}
		}
		
		t0 = wall_clock();
		for(i = 0; i<N; i++){
			for(j= 0; j<N; j++){
				for(k = 0; k<N; k++){
					(C[i][j] += A[i][k]*B[k][j]);
				}
			}
		} 
		t1 = wall_clock()-t0;
		
		if(t1>0) Mflops = ((N*N)/t1)*N;
		else Mflops = 0;
		
		
		sprintf(query, "insert into PLogs(Timestamp, Host, Size, ElapsedTime, MFLOPS, LoopOrder) values (\"%s\",\"%s\",%d, %f,%f,\"i-j-k\")",
		asctime(newtime), host, N, t1, Mflops);
		if(mysql_query(con,query)){
			perror(mysql_error(con));
			exit(-2);
		}
		
		//for ikj
		
		for(i = 0; i<N; i++)
		{
			for(j= 0; j<N; j++)
			{
				C[i][j] = 0;
				A[i][j] = (double)(i*j);
				B[i][j] = (double) (i*j);
				
			}
		}
		
		t0 = wall_clock();
		for(i = 0; i<N; i++){
			for(k= 0; k<N; k++){
				for(j = 0; j<N; j++){
					(C[i][j] += A[i][k]*B[k][j]);
				}
			}
		} 
		t1 = wall_clock()-t0;
	
		if(t1>0) Mflops = ((N*N)/t1)*N;
		else Mflops = 0;
		
		sprintf(query, "insert into PLogs(Timestamp, Host, Size, ElapsedTime, MFLOPS, LoopOrder) values (\"%s\",\"%s\",%d, %f,%f,\"i-k-j\")",
		asctime(newtime), host, N, t1, Mflops);
		if(mysql_query(con,query)){
			perror(mysql_error(con));
			exit(-2);
		}
		
		//for jki
		
		for(i = 0; i<N; i++)
		{
			for(j= 0; j<N; j++)
			{
				C[i][j] = 0;
				A[i][j] = (double)(i*j);
				B[i][j] = (double) (i*j);
				
			}
		}
		
		t0 = wall_clock();
		for(j = 0; j<N; j++){
			for(k= 0; k<N; k++){
				for(i = 0; i<N; i++){
					(C[i][j] += A[i][k]*B[k][j]);
				}
			}
		} 
		t1 = wall_clock()-t0;
		
		if(t1>0) Mflops = ((N*N)/t1)*N;
		else Mflops = 0;
		
		sprintf(query, "insert into PLogs(Timestamp, Host, Size, ElapsedTime, MFLOPS, LoopOrder) values (\"%s\",\"%s\",%d, %f,%f,\"j-k-i\")",
		asctime(newtime), host, N, t1, Mflops);
		if(mysql_query(con,query)){
			perror(mysql_error(con));
			exit(-2);
		}
		
		//for jik
		
		for(i = 0; i<N; i++)
		{
			for(j= 0; j<N; j++)
			{
				C[i][j] = 0;
				A[i][j] = (double)(i*j);
				B[i][j] = (double) (i*j);
				
			}
		}
		
		t0 = wall_clock();
		for(j = 0; j<N; j++){
			for(i= 0; i<N; i++){
				for(k = 0; k<N; k++){
					(C[i][j] += A[i][k]*B[k][j]);
				}
			}
		} 
		t1 = wall_clock()-t0;

		if(t1>0) Mflops = ((N*N)/t1)*N;
		else Mflops = 0;
		
		sprintf(query, "insert into PLogs(Timestamp, Host, Size, ElapsedTime, MFLOPS, LoopOrder) values (\"%s\",\"%s\",%d, %f,%f,\"j-i-k\")",
		asctime(newtime), host, N, t1, Mflops);
		if(mysql_query(con,query)){
			perror(mysql_error(con));
			exit(-2);
		}

		
		//for kij
		
		for(i = 0; i<N; i++)
		{
			for(j= 0; j<N; j++)
			{
				C[i][j] = 0;
				A[i][j] = (double)(i*j);
				B[i][j] = (double) (i*j);
				
			}
		}
		
		t0 = wall_clock();
		for(k = 0; k<N; k++){
			for(i= 0; i<N; i++){
				for(j = 0; j<N; j++){
					(C[i][j] += A[i][k]*B[k][j]);
				}
			}
		} 
		t1 = wall_clock()-t0;
		
		if(t1>0) Mflops = ((N*N)/t1)*N;
		else Mflops = 0;
		
		sprintf(query, "insert into PLogs(Timestamp, Host, Size, ElapsedTime, MFLOPS, LoopOrder) values (\"%s\",\"%s\",%d, %f,%f,\"k-i-j\")",
		asctime(newtime), host, N, t1, Mflops);
		if(mysql_query(con,query)){
			perror(mysql_error(con));
			exit(-2);
		}
	
		//for kji
		
		for(i = 0; i<N; i++)
		{
			for(j= 0; j<N; j++)
			{
				C[i][j] = 0;
				A[i][j] = (double)(i*j);
				B[i][j] = (double) (i*j);
				
			}
		}
		
		t0 = wall_clock();
		for(k = 0; k<N; k++){
			for(j= 0; j<N; j++){
				for(i = 0; i<N; i++){
					(C[i][j] += A[i][k]*B[k][j]);
				}
			}
		} 
		t1 = wall_clock()-t0;

		if(t1>0) Mflops = ((N*N)/t1)*N;
		else Mflops = 0;
		
		sprintf(query, "insert into PLogs(Timestamp, Host, Size, ElapsedTime, MFLOPS, LoopOrder) values (\"%s\",\"%s\",%d, %f,%f,\"k-j-i\")",
		asctime(newtime), host, N, t1, Mflops);
		if(mysql_query(con,query)){
			perror(mysql_error(con));
			exit(-2);
		}
		
		mysql_close(con);
}


