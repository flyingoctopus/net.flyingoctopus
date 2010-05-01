import processing.core.*; 
import processing.xml.*; 

import traer.physics.*; 
import java.util.Vector; 

import java.applet.*; 
import java.awt.Dimension; 
import java.awt.Frame; 
import java.awt.event.MouseEvent; 
import java.awt.event.KeyEvent; 
import java.awt.event.FocusEvent; 
import java.awt.Image; 
import java.io.*; 
import java.net.*; 
import java.text.*; 
import java.util.*; 
import java.util.zip.*; 
import java.util.regex.*; 

public class prototype extends PApplet {




Vector tendrils;
ParticleSystem physics;
Particle mouse;
int greyer;
boolean drawing;
boolean nothingDrawn;
    
public void setup()
{
  size( 400, 400 );
  smooth();
  stroke( 0 );
  background( 255 );
  frameRate( 30 );
  cursor( CROSS );	  

  physics = new ParticleSystem( 0.0f, 0.05f );
	  
  mouse = physics.makeParticle();
  mouse.makeFixed();
	  
  tendrils = new Vector();
  drawing = false;
  greyer = 255;
}
	
public void draw()
{
  mouse.position().set( mouseX, mouseY, 0 );
		
  if ( !drawing )
  {
    physics.tick( 1.0f );
    if ( greyer <  255 )
      greyer *= 1.11111f;
    if ( greyer >  255 )
      greyer = 255;
  }
  else
  {
    if ( greyer >= 64 )
      greyer *= 0.9f;
  }
		
  background( 255 );
		
  drawOldGrey();
}
	
public void drawOldGrey()
{
  stroke( 255 - greyer );
  for ( int i = 0; i <  tendrils.size()-1; ++i )
  {
    T3ndril t = (T3ndril)tendrils.get( i );
    drawElastic( t );
  }
		
  stroke( 0 );
  if ( tendrils.size()-1 >= 0 )
    drawElastic( (T3ndril)tendrils.lastElement() );
}
	
public void drawElastic( T3ndril t )
{
  float lastStretch = 1;
  for ( int i = 0; i <  t.particles.size()-1; ++i )
  {
    Vector3D firstPoint = ((Particle)t.particles.get( i )).position();
    Vector3D firstAnchor =  i <  1 ? firstPoint : ((Particle)t.particles.get( i-1 )).position();
    Vector3D secondPoint = i+1 <  t.particles.size() ? ((Particle)t.particles.get( i+1 )).position() : firstPoint;
    Vector3D secondAnchor = i+2 <  t.particles.size() ? ((Particle)t.particles.get( i+2 )).position() : secondPoint;
			
    //float springStretch = 2.5f/((Spring)t.springs.get( i )).stretch();
    Spring s = (Spring)t.springs.get( i );
    float springStretch = 2.5f*s.restLength()/s.currentLength();
    			
    strokeWeight( (float)((springStretch + lastStretch)/2.0f) );	// smooth out the changes in stroke width with filter
    lastStretch = springStretch;
			
    curve( firstAnchor.x(), firstAnchor.y(),
           firstPoint.x(), firstPoint.y(),
	   secondPoint.x(), secondPoint.y(),
	   secondAnchor.x(), secondAnchor.y() );
  }
}
	
public void mousePressed()
{
  drawing = true;
  tendrils.add( new T3ndril( physics, new Vector3D( mouseX, mouseY, 0 ), 								   mouse ) );
}
	
public void mouseDragged()
{
  ((T3ndril)tendrils.lastElement()).addPoint( new Vector3D( mouseX, mouseY, 0 ) );
}
	
public void mouseReleased()
{
  drawing = false;
}
	
public void keyPressed()
{
  if ( key == ' ' )
  {
    tendrils.clear();
    physics.clear();
  }
}

class T3ndril
{
	public Vector particles;
	public Vector springs;
	ParticleSystem physics;
	
	public T3ndril( ParticleSystem p, Vector3D firstPoint, Particle followPoint )
	{
		particles = new Vector();
		springs = new Vector();
		
		physics = p;
		
		Particle firstParticle = p.makeParticle( 1.0f, firstPoint.x(), firstPoint.y(), firstPoint.z() );
		particles.add( firstParticle );
		physics.makeSpring( followPoint, firstParticle, 0.1f, 0.1f, 5 );
	}

	public void addPoint( Vector3D p )
	{
		Particle thisParticle = physics.makeParticle( 1.0f, p.x(), p.y(), p.z() );
		springs.add( physics.makeSpring( ((Particle)particles.lastElement()),
											 thisParticle, 
											 1.0f,
											 1.0f,
											 ((Particle)particles.lastElement()).position().distanceTo( thisParticle.position() ) ) );
		particles.add( thisParticle );
	}
}
  static public void main(String args[]) {
    PApplet.main(new String[] { "--bgcolor=#FFFFFF", "prototype" });
  }
}
