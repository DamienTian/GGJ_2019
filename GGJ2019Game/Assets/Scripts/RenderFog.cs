using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class RenderFog : MonoBehaviour
{
    public Shader fogShader;
    public float flikerAmount = 0.2f;
    public int flickerFrequency = 30;
    public float sight;
    private float sightF;
    private Material fogMaterial;
    private Camera fogCamera;
    private Vector3 leftTopRay;
    private Vector3 leftBottomRay;
    private Vector3 rightTopRay;
    private Vector3 rightBottomRay;
    private CompleteCameraController cameraController;
    // Start is called before the first frame update
    void Start()
    {
        fogMaterial = new Material(fogShader);
        cameraController = GetComponent<CompleteCameraController>();
        fogCamera = GetComponent<Camera>();
        InvokeRepeating("SightFlicker", 0, 1 / (float)flickerFrequency);
    }

    // Update is called once per frame
    void Update()
    {
        fogMaterial.SetFloat("_Sight", sightF);
        fogMaterial.SetVector("_Camra2Plyer", cameraController.player.transform.position - cameraController.transform.position);
    }

    void SightFlicker()
    {
        sightF = sight + Random.value * 2 * flikerAmount - flikerAmount;
        Debug.Log(sight);
    }

    [ImageEffectOpaque]
    private void OnRenderImage(RenderTexture source, RenderTexture destination)
    {
        fogCamera.depthTextureMode = DepthTextureMode.Depth;
        Transform camTran = fogCamera.transform;
        float camFar = fogCamera.farClipPlane;
        float camFovHalf = fogCamera.fieldOfView / 2;
        float camAsp = fogCamera.aspect;
        Vector3 toTop = camFar * Mathf.Tan(camFovHalf * Mathf.Deg2Rad) * camTran.up;
        Vector3 toRight = camFar * Mathf.Tan(camFovHalf * Mathf.Deg2Rad) * camAsp * camTran.right;
        Vector3 toFront = camFar * camTran.forward;

        leftTopRay = toFront - toRight + toTop;
        leftBottomRay = toFront - toRight - toTop;
        rightTopRay = toFront + toRight + toTop;
        rightBottomRay = toFront + toRight - toTop;

        MyFogBlit(source, destination, fogMaterial);
    }

    void MyFogBlit(RenderTexture src, RenderTexture dest, Material fogMaterial)
    {
        RenderTexture.active = dest;

        fogMaterial.SetTexture("_MainTex", src);

        GL.PushMatrix();
        GL.LoadOrtho();

        //generate the quad
        GL.Begin(GL.QUADS);

        fogMaterial.SetPass(0);

        //Left Bottom -> Right Bottom -> Right Top -> Left Top
        GL.MultiTexCoord2(0, 0, 0);
        GL.MultiTexCoord(1, leftBottomRay);
        GL.Vertex3(0, 0, 0);

        GL.MultiTexCoord2(0, 1, 0);
        GL.MultiTexCoord(1, rightBottomRay);
        GL.Vertex3(1, 0, 0);

        GL.MultiTexCoord2(0, 1, 1);
        GL.MultiTexCoord(1, rightTopRay);
        GL.Vertex3(1, 1, 0);

        GL.MultiTexCoord2(0, 0, 1);
        GL.MultiTexCoord(1, leftTopRay);
        GL.Vertex3(0, 1, 0);

        GL.End();
        GL.PopMatrix();
    }
}
