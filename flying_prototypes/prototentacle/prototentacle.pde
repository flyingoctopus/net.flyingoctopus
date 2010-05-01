//Limbs Part

int width = 800;
int height = 800;

int nTentacles = 10;

int nSegs = 30;
float totalLength = width/2;  
float downScaling = .9;
float baseLength;
float baseThickness = 30;
float maxdTheta = 1.5*(2*PI)/nSegs;
float maxdThetaVelPerStep = maxdTheta/40;
float maxThetaVel = maxdThetaVelPerStep*2;
float trickleVelScaling = nSegs*.003;

boolean centeredTentacles = false;
boolean drawSuckers = true;

color backgroundColor = color(255,255,255);
color tentacleColor = 0;
color suckerColor = #D1F6FA;
color suckerOutlineColor = 0;
float suckerScale = 1.8;


Tentacle[] tentacles;


void setup()
{
	frameRate(30);
	smooth();
	size(width,height);
 
	tentacles = new Tentacle[nTentacles];
	for(int i=0; i<nTentacles; i++){
		if(centeredTentacles)
			tentacles[i] = new Tentacle(width/2, height/2, TWO_PI/nTentacles*i-PI/2);
		else
			tentacles[i] = new Tentacle(width/2+totalLength/1.5*cos(TWO_PI/nTentacles*i),
											height/2+totalLength/1.5*sin(TWO_PI/nTentacles*i),
											TWO_PI/nTentacles*i+PI);
	}
}

void draw()
{
	blankScreen();  
 	
	for(int i=0; i<nTentacles; i++)
	{
		tentacles[i].drawTentacle();
		tentacles[i].wiggleTentacle();
	}
}

void blankScreen()
{
	fill(backgroundColor);
	noStroke();
	rect(0,0,width,height);
}



//Tentacle Part


class Tentacle
{
	float x0,y0,theta0;
	float[] segLengths;
	float[] segThetas;
 
	Tentacle(float x0i, float y0i, float theta0i)
	{
		x0 = x0i;
		y0 = y0i;
		theta0 = theta0i;

		baseLength = totalLength*(downScaling-1)/(pow(downScaling,nSegs)-1);

		segLengths = new float[nSegs];
		segThetas = new float[nSegs];
		for(int i=0; i<nSegs; i++)
		{
			if(i==0)
				segLengths[i] = baseLength;
			else
				segLengths[i] = segLengths[i-1]*downScaling;
		}
	}

	void drawTentacle()
	{
		float x1 = width;
		float y1 = y0;
		float x2 = x0;
		float y2 = y0;  
		float totalTheta = theta0;
		
		for(int i=0; i<nSegs; i++)
		{
			stroke(tentacleColor);
			strokeWeight(baseThickness*segLengths[i]/segLengths[0]);
			totalTheta+=segThetas[i];
			x2 = x1+segLengths[i]*cos(totalTheta);
			y2 = y1+segLengths[i]*sin(totalTheta);
			line(x1,y1,x2,y2);

			if(drawSuckers)
			{
				fill(suckerColor);
				stroke(suckerOutlineColor);
				strokeWeight(0);
				ellipse((x1+x2)/2,(y1+y2)/2,
				baseThickness*segLengths[i]/segLengths[0]*suckerScale,
				baseThickness*segLengths[i]/segLengths[0]*suckerScale);

			}
			
			x1 = x2;
			y1 = y2;
		}
	}
 
 
	float[] segVelocities = new float[nSegs];
 
	void wiggleTentacle()
	{
		
		for(int i = 0; i<nSegs; i++)
		{


			if(segThetas[i] <= -maxdTheta || segThetas[i] >= maxdTheta)
				segVelocities[i] = 0;
		}

		for(int i = nSegs-2; i>=0; i--)
		{
			segVelocities[i] += segVelocities[i+1]*trickleVelScaling;
		}
   
 
		segVelocities[nSegs-10] += random(-maxdThetaVelPerStep,maxdThetaVelPerStep);
   

		int sign = 1;

		for(int i = 0; i<nSegs; i++)
		{
			if(segThetas[i]>0 && segVelocities[i]>0)
			{
				segVelocities[i] = min(segVelocities[i],
									maxThetaVel*(1-segThetas[i]/maxdTheta));
			}
	
	
			if(segThetas[i]<0 && segVelocities[i]<0)
			{
				segVelocities[i] = min(abs(segVelocities[i]),
									maxThetaVel*(1-abs(segThetas[i])/maxdTheta));
				segVelocities[i] = -segVelocities[i];
			}
		}
   

		for(int i = 0; i<nSegs; i++)
		{
			segThetas[i] = constrain(segThetas[i]+segVelocities[i],
										-maxdTheta*(1-i/nSegs),
										maxdTheta*(1-i/nSegs));
		}
	}
}