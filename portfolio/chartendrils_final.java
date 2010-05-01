import processing.core.*; import traer.physics.*; import java.util.Vector; import geomerative.*; import java.applet.*; import java.awt.*; import java.awt.image.*; import java.awt.event.*; import java.io.*; import java.net.*; import java.text.*; import java.util.*; import java.util.zip.*; import javax.sound.midi.*; import javax.sound.midi.spi.*; import javax.sound.sampled.*; import javax.sound.sampled.spi.*; import java.util.regex.*; import javax.xml.parsers.*; import javax.xml.transform.*; import javax.xml.transform.dom.*; import javax.xml.transform.sax.*; import javax.xml.transform.stream.*; import org.xml.sax.*; import org.xml.sax.ext.*; import org.xml.sax.helpers.*; public class chartendrils_final extends PApplet {/*

 
 vincent[at]flyingoctopus.com
 http://flyingoctopus.net/

 Built with Processing (Beta) v0135
 uses Geomerative (Alpha) v004
 ----------------------------------------------------------------
 
 Created 24 February 2006
 
 ---------------------------------------------------------------- 
 typeicles
 ---------------------------------------------------------------- 
 
 */





RGroup grupo;

RFont f;

Vector tendrils;
ParticleSystem physics;
Particle mouse;

//------------------------ Runtime properties ----------------------------------
// Save each frame
boolean SAVEVIDEO = false;
boolean SAVEFRAME = false;
//------------------------------------------------------------------------------

//------------------------ Drawing properties ----------------------------------
// Text to be drawn
String STRNG = "vincent";

// Font to be used
String FONT = "DroidSansMono.ttf";

// Margin from the borders
float MARGIN = 7;
//------------------------------------------------------------------------------


String newString = "";


public void setup(){
  size(1000,560);
  frameRate(25);
  try{
    smooth();
  }
  catch(Exception e){
  }
  stroke( 0 );
  background(255);
  cursor( CROSS );


  RCommand.setSegmentator(RCommand.UNIFORMLENGTH);
  RCommand.setSegmentLength(10);
  
  initialize();
}

public void draw(){
  background( 255 );
  translate(width/2, height/2);

  if(mousePressed){
    mouse.moveTo( mouseX-width/2, mouseY-height/2, 0 );
    for ( int i = 0; i < tendrils.size(); ++i )
    {
      T3ndril t = (T3ndril)tendrils.get( i );
      t.firstspring.turnOn();
    }
  }else{
    for ( int i = 0; i < tendrils.size(); ++i )
    {
      T3ndril t = (T3ndril)tendrils.get( i );
      t.firstspring.turnOff();
    }
  }  

  physics.advanceTime( 1.0f );

  stroke(0);

  for ( int i = 0; i < tendrils.size(); ++i )
  {
    T3ndril t = (T3ndril)tendrils.get( i );
    drawElastic( t );
  }

  if(SAVEVIDEO) saveFrame(STRNG+"video-####.tga");
}

public void drawElastic( T3ndril t )
{
  float lastStretch = 1;
  for ( int i = 0; i < t.particles.size()-1; ++i )
  {
    Vector3D firstPoint = ((Particle)t.particles.get( i )).position();
    Vector3D firstAnchor =  i < 1 ? firstPoint : ((Particle)t.particles.get( i-1 )).position();
    Vector3D secondPoint = i+1 < t.particles.size() ? ((Particle)t.particles.get( i+1 )).position() : firstPoint;
    Vector3D secondAnchor = i+2 < t.particles.size() ? ((Particle)t.particles.get( i+2 )).position() : secondPoint;

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

public void keyReleased(){
  initialize();
  //exit();
  //saveFrame(STRNG+"-###.tga");
}

public void initialize(){
  if(tendrils!=null){
    tendrils.clear();
  }
  
  if(physics!=null){
    physics.clear();
  }
  
  f = new RFont(this,FONT,372,RFont.CENTER);
  grupo = f.toGroup(STRNG);

  RCommand.setSegmentator(RCommand.UNIFORMLENGTH);
  RCommand.setSegmentLength(20);

  grupo = grupo.toPolygonGroup();
  grupo.centerIn(g, MARGIN, 1, 1);

  physics = new ParticleSystem( 0.0f, 0.05f );

  mouse = physics.makeParticle();
  mouse.makeFixed();

  tendrils = new Vector();
  
  if(grupo!=null){
    for(int k=0;k<grupo.countElements();k++){
      RPolygon p = (RPolygon)(grupo.elements[k]);
      if(p!=null){
        for(int i=0;i<p.countContours();i++){
          RPoint[] ps = p.contours[i].getPoints();
          if(ps!=null){
            tendrils.add( new T3ndril( physics, new Vector3D( ps[0].x, ps[0].y, 0 ), mouse ) );
            for(int j=1;j<ps.length;j++){
              ((T3ndril)tendrils.lastElement()).addPoint( new Vector3D( ps[j].x, ps[j].y, 0 ) );
            }
            ((T3ndril)tendrils.lastElement()).addPoint( new Vector3D( ps[0].x, ps[0].y, 0 ) );
          }
        }
      }
    }
  }
}

class T3ndril
{
  public Vector particles;
  public Vector springs;
  public Spring firstspring;
  ParticleSystem physics;

  public T3ndril( ParticleSystem p, Vector3D firstPoint, Particle followPoint )
  {
    particles = new Vector();
    springs = new Vector();

    physics = p;

    Particle firstParticle = p.makeParticle( 1.0f, firstPoint.x(), firstPoint.y(), firstPoint.z() );
    particles.add( firstParticle );
    firstspring = physics.makeSpring( followPoint, firstParticle, 0.1f, 0.1f, 5 );
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


public void resize(int w, int h) 
{ 
  super.resize(w,h); 
  if (g != null) 
    smooth(); 
} 

  static public void main(String args[]) {     PApplet.main(new String[] { "chartendrils_final" });  }}